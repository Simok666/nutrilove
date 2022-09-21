<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Content;
use App\Models\Leaflet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class LeafletController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTables::of(Leaflet::query())->toArray();
            $data["data"] = array_map(function ($item) {
                $item["action"] = '
                <button class="btn btn-warning icon btn-update" data-id="' . $item["id"] . '">
                    <i data-feather="edit"></i>
                </button>
                <button class="btn btn-danger icon btn-delete" data-id="' . $item["id"] . '" data-name="' . $item["title"] . '">
                    <i data-feather="trash-2"></i>
                </button>
                ';
                return $item;
            }, $data["data"]);
            // dd($data);
            // print_r($data["data"]);
            unset($data["queries"]);
            return $data;
        }

        return view('admin.leaflet');
    }

    public function form(Request $request)
    {
        return view('admin.master.leaflet_form', ["id_update" => $request->id]);
    }

    public function upsert(Request $request)
    {
        $data = $request->all();
        
        if (!empty($request->kode)) {
            $rules = array('kode' => 'required|unique:content,kode');

            if (!empty($request->id)) {
                $rules["kode"] = $rules["kode"] . ',' . $request->id;
            }

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $resutl = [
                    "IsError" => true,
                    "Message"   => "That kode is already registered"
                ];
                goto ResultData;
            }
        }

        if (!empty($request->fileBase64)) {
            $file = $request->fileBase64;
            $extension = 'pdf';
            $imageName = Str::random(10) . '.' . $extension;
            $data['file'] = Storage::disk('public')->put($imageName, base64_decode($file));
            $data['file'] = url('storage/'.$imageName);
        }      

        $data = Leaflet::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        
        if ($data) {
            $resutl = [
                "IsError" => false,
                "Message"   => "Data Berhasil Disimpan"
            ];
        } else {
            $resutl = [
                "IsError" => true,
                "Message"   => "Data Gagal Disimpan"
            ];
        }

        ResultData:
        return $resutl;
    }
}

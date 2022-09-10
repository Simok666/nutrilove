<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTables::of(Faq::query())->toArray();
            $data["data"] = array_map(function ($item) {
                $item["action"] = '
                <button class="btn btn-warning icon btn-update" data-id="' . $item["id"] . '">
                    <i data-feather="edit"></i>
                </button>
                <button class="btn btn-danger icon btn-delete" data-id="' . $item["id"] . '" data-name="' . $item["name"] . '">
                    <i data-feather="trash-2"></i>
                </button>
                ';
                return $item;
            }, $data["data"]);
            // print_r($data["data"]);
            unset($data["queries"]);
            return $data;
        }

        return view('admin.faq');
    }

    public function form(Request $request)
    {
        return view('admin.master.faq_form', ["id_update" => $request->id]);
    }

    public function upsert(Request $request)
    {
        $data = $request->all();

        if (!empty($request->name)) {
            $rules = array('name' => 'required|unique:faq,name');

            if (!empty($request->id)) {
                $rules["name"] = $rules["name"] . ',' . $request->id;
            }

            $validator = Validator::make($data, $rules);
            // dd($data);
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
            $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            $replace = substr($file, 0, strpos($file, ',') + 1);
            $image = str_replace($replace, '', $file);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . $extension;

            $request->validate([
                $file => 'mimes:jpeg,bmp,png|max:1000' // Only allow .jpg, .bmp and .png file types.
            ]);
            $data['file'] = Storage::disk('public')->put($imageName, base64_decode($image));
            $data['file'] = url('storage/'.$imageName);
        }

        // $dom=new \DOMDocument();
        // libxml_use_internal_errors(true);
        // $dom->loadHTML($request->message,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        // libxml_clear_errors();
        // $images=$dom->getElementsByTagName('img');
        // foreach($images as $k => $img){
        //     $src=$img->getAttribute('src');
        //     if(preg_match('/data:image/',$src)){
        //         $dataImg = $img->getAttribute('src');
        //         list($type, $dataImg) = explode(';', $dataImg);
        //         list(, $dataImg)      = explode(',', $dataImg);
        //         $dataImg = base64_decode($dataImg);

        //         $image_name = "/uploads/img/artikel/". Str::random(9).time().$k.'.png';

        //         $dataImg = Storage::disk('public')->put($image_name, $dataImg);
        //         $image_name = url('storage'.$image_name);
            
        //         $img->removeAttribute('src');
        //         $img->setAttribute('src', $image_name);
        //     }
        // }

        // $data["message"] = $dom->saveHTML();
        
        $data = Faq::updateOrCreate(
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

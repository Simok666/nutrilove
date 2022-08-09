<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\SettingGizi;

class SettingGiziController extends Controller
{
    public function index(Request $request)
    {
        // return $request;
        if ($request->ajax()) {
            $data = DataTables::of(SettingGizi::query())->toArray();
            $data["data"] = array_map(function ($item) {
                $item["action"] = '
                <button class="btn btn-warning icon btn-update" data-id="' . $item["id"] . '">
                    <i data-feather="edit"></i>
                </button>
                <button class="btn btn-danger icon btn-delete" data-id="' . $item["id"] . '" data-name="' . $item["keterangan"] . '">
                    <i data-feather="trash-2"></i>
                </button>
                ';
                return $item;
            }, $data["data"]);
            // print_r($data["data"]);
            unset($data["queries"]);
            return $data;
        }

        return view('admin.setting_gizi');
    }

    public function upsert(Request $request)
    {
        $data = $request->all();
        $data = SettingGizi::updateOrCreate(
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // return $request;
        if ($request->ajax()) {
            $data = DataTables::of(User::query())->toArray();
            $data["data"] = array_map(function ($item) {
                $item["action"] = '
                <button class="btn btn-warning icon btn-admin-update" data-id="' . $item["id"] . '">
                    <i data-feather="edit"></i>
                </button>
                <button class="btn btn-danger icon btn-admin-delete" data-id="' . $item["id"] . '" data-name="' . $item["name"] . '" data-email="' . $item["email"] . '">
                    <i data-feather="trash-2"></i>
                </button>
                ';
                return $item;
            }, $data["data"]);
            // print_r($data["data"]);
            unset($data["queries"]);
            return $data;
        }

        return view('admin.admin');
    }

    public function upsert(Request $request)
    {
        $resutl = [];
        $data = $request->all();

        if (!empty($request->password)) {
            if ($request->password !== $request->password2) {
                $resutl = [
                    "IsError" => true,
                    "Message"   => "Password Harus Sama"
                ];
                goto ResultData;
            }
        }

        if (!empty($request->email)) {
            $rules = array('email' => 'required|email|unique:users,email');

            if (!empty($request->id)) {
                $rules["email"] = $rules["email"] . ',' . $request->id;
            }
            // die(json_encode($rules));
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $resutl = [
                    "IsError" => true,
                    "Message"   => "That email address is already registered"
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
                $file => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $data['photo'] = Storage::disk('public')->put($imageName, base64_decode($image));
            $data['photo'] = 'storage/'.$imageName;
        }

        $data = User::updateOrCreate(
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

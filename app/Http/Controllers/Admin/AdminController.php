<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    public function showContent()
    {
        $data['menu'] = DB::select("select * from menu");
        return view('admin.content', $data);
    }
    public function showtables(Request $request, $table)
    {
        $table = $request->input("table");
        $view = $request->input("view");
        $view = $view == "" ? $table : $view;

        $data = [];

        $data['data'] = DB::select("select * from $table");

        $returnHTML = view::first(["admin.master.$view"], $data)->render();

        return response()->json(array('success' => true, 'html' => $returnHTML));
    }
    public function save(Request $request, $table)
    {
        $data = $request->all();
        $file = $request->input('file');

        if ($file) {
            $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            $replace = substr($file, 0, strpos($file, ',') + 1);
            $image = str_replace($replace, '', $file);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . $extension;

            $request->validate([
                $file => 'mimes:jpeg,bmp,png|max:1000' // Only allow .jpg, .bmp and .png file types.
            ]);
            $data['file'] =  Storage::disk('public')->put($imageName, base64_decode($image));
        }

        foreach ($data as $key => $value) {
            if ($key != 'id') $data[$key] = strtoupper($value);
        }
        unset($data['_token']);

        $result = DB::select(DB::raw("SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'"));
        $primaryKey = $result[0]->Column_name;

        DB::table($table)->updateOrInsert(
            [$primaryKey => $data[$primaryKey]],
            $data
        );
        echo json_encode("oke");
    }

    public function delete(Request $request, $table)
    {
        $data = DB::table($table)->where('id', '=', $request["id"])->delete();
        if ($data) {
            $status = false;
            $message = "Data Berhasi dihapus";
        } else {
            $status = true;
            $message = "Data Gagal dihapus";
        }
        return [
            "IsError"   => $status , 
            "Message"   => $message
        ];
    }

    public function detail(Request $request, $table)
    {
        $data = DB::table($table)->where('id', '=', $request["id"])->get();
        if ($data) {
            $status = false;
            $message = "Data Berhasi";
        } else {
            $status = true;
            $message = "Data tidak ada";
        }
        return [
            "IsError"   => $status , 
            "Message"   => $message,
            "Data"      => $data
        ];
    }
    
}

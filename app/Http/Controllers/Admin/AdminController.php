<?php

namespace App\Http\Controllers\Admin;
use App\Library\Services\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function showContent(){
        $data['menu'] = DB::select("select * from menu");
        return view('admin.content',$data);
    }
    public function showtables(Request $request,$table){
        $table = $request->input("table") ;
        $view = $request->input("view") ;
        $view = $view == "" ? $table : $view ;
        
        $data = [] ;
        
        $data['data'] = DB::select("select * from $table");
        
        $returnHTML = view::first(["admin.master.$view"],$data)->render();
        
        return response()->json( array('success' => true, 'html'=>$returnHTML) );        
    }
}
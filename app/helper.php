<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function getFile($file){
    return Storage::urldecode($file);
}

function getTable($table){
    $data = DB::select("select * from $table");
    return $data;
}

function getDataTable($field,$table,$join='',$where = '',$group='',$order='',$limit =''){
    $where = $where != '' ? "where ".$where : $where ;
    $group = $group != '' ? "group by ".$group : $group ;
    $order = $order != '' ? "order by ".$order : $order ;
    $limit = $limit != '' ? "limit  ".$limit : $limit ;
    $data = DB::select("select $field from $table $join $where $group $order $limit");    
    return $data ;
}


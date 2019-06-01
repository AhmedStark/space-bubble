<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainMapController extends Controller
{
    public function update(Request $request ){
        $mainMapFile = fopen(base_path("resources/views/big-map.blade.php"), "w");
        fwrite($mainMapFile,"@extends('main-template')
@section('content')
<head><title>Space bubble</title></head>
<navigation-map :dark=\"darkMode.dark\">
<div slot=\"map\" >
".$this->saveMapFile($request)."</div>

</navigation-map>
@endSection");
        fclose($mainMapFile);
        return ['status'=>1,'response'=>"<p class='success'>Map changed successfully</p>"];
    }
    public function saveMapFile(Request $request){
        $file = $request->file('map'); // get the file user sent via POST

        $heightPattren = "/\sheight=\"[0-9a-z]*\"/";
        $widthPattren = "/\swidth=\"[0-9a-z]*\"/";
        $svgFile = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>','',file_get_contents($file)) ;
        $svgFile = preg_replace($heightPattren, "", $svgFile);
        $svgFile = preg_replace($widthPattren, "", $svgFile);
        return $svgFile;
    }
}


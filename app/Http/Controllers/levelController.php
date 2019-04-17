<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Area;
use App\Table;
use DB;
class levelController extends Controller
{
    
    public function create()
    {
        return view('level.create');
    }
    public function showLevels(){
        return view('levels.index');
    }

    public function showAreas($id){
        $level_id=$id;
        if(!Level::find($id)){
            return [];
        }
        $areas=Level::find($level_id)->areas()->get();
        return $areas;
    }
    
    

    public function store(Request $request)
    {
        $level=new Level;

        $level->building_id= $request->building_id;
        $level->name=$request->name;

        $level->save();
        $this->registerComponent($level->id);
        return ["data"=>$request->all(),"response"=>"<p class='success--text'>Building was created</p>","status"=>1];
    }


    public function changeMap(Request $request,$id)
    {   
        if($level = Level::find($id)){
            $level->name = $request->name;
            $level->save();
        }else{
            return ["response"=>'level not found'];
        }
        $checkMapID = $request->file('map')!==null;
        $mapID=$id;
        
        if($checkMapID){
            $compenet = fopen(base_path("resources/js/components/maps/")."map-".$mapID.".vue", "w"); 
            fwrite($compenet, 
"<template>\n<area-map v>\n    <div slot=\"map\">\n\n         ".$this->saveMapFile($request)." \n\n   </div>\n</area-map></template>");
            fclose($compenet);
        }
        return ["response"=>"<p class='success--text'>Building was created</p>","status"=>1];
    }

    public function writeVueFile($mapID,$content){
        $compenet = fopen(base_path("resources/js/components/maps/")."map-".$mapID.".vue", "w"); 
            fwrite($compenet, 
"<template>\n<area-map v>\n    <div slot=\"map\">\n\n         ".$content." \n\n   </div>\n</area-map></template>");
            fclose($compenet);
    
            
    }

    public function saveMapFile(Request $request){
        $file = $request->file('map'); // get the file user sent via POST
        return str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>','',file_get_contents($file)) ;
    }

    public function registerComponent($mapID){
        $appJsBath=base_path("resources/js/app.js");
        $txt=file_get_contents($appJsBath);
        $spliter="//--------------------";
        $arr =explode($spliter,$txt);
        $appJsWrite = fopen($appJsBath,"w");
        $this->writeVueFile($mapID,"");
        $newAppJsFileContent = $arr[0]."\nVue.component('map-".$mapID."', require('./components/maps/map-".$mapID.".vue').default);\n".$spliter.$arr[1];
        fwrite($appJsWrite,$newAppJsFileContent);
        fclose($appJsWrite);
    }
    public function delete($id,Request $request){
    
        
        $areas=Level::find($id)->areas();
        
        foreach ($areas->get() as $area){
            $area_id=$area->id;
            
            
            $tables=Area::find($area_id)->tables();
            $tables->delete();
        }
        $areas->delete();
        DB::table('levels')->where('id', '=', $id)->delete();

        return ["response"=>"Area deleted!", 'request'=>$request->all(),'status'=>1];
        
    }
    public function update(Request $request){
        DB::table('levels')
            ->where('id', $request->id)
            ->update(['name' =>$request->name]);

    }
    
}

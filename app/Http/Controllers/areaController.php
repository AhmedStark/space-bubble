<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use DB;
class areaController extends Controller
{
    
    public function create()
    {
        return view('area.create');
    }

   
    public function store(Request $request)
    {
        $area=new Area;

        $area->level_id= $request->level_id;
        $area->name=$request->name;

        $area->save();

        return ["response"=>"<p class='success--text'>Building was created</p>","status"=>1];
    }

    public function delete(Request $request){
        $id=$request->id;
        $tables=Area::find($id)->tables();
        $tables->delete();
        DB::table('areas')->where('id', '=', $id)->delete();
    }

    public function showAreas(){
        return view('areas.index');
    }

    public function showTables(Request $request){
        $area_id=$request->area_id;
        
        $tables=Area::find($area_id)->tables()->get();
        return $tables;
    }


    public function totalTables(Request $request){
        $area_id=$request->area_id;
        $count=Area::find($area_id)->tables()->count();
        return $count;
    }
    public function totalTakenTables(Request $request){
        $area_id=$request->area_id;
        $count=Area::find($area_id)->tables()->where('taken','=',1)->count(); 
        return $count;
    }
}

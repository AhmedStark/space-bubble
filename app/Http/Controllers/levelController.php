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
        
        $areas=Level::find($level_id)->areas()->get();
        return $areas;
    }
    
    

    public function store(Request $request)
    {
        $level=new Level;

        $level->building_id= $request->building_id;
        $level->name=$request->name;

        $level->save();

        return ["response"=>"<p class='success--text'>Building was created</p>","status"=>1];
    }


    public function delete(Request $request){
        $id=$request->id;
        
        $areas=Level::find($id)->areas();
        
        foreach ($areas->get() as $area){
            $area_id=$area->id;
            
            
            $tables=Area::find($area_id)->tables();
            $tables->delete();
        }
        $areas->delete();
        DB::table('levels')->where('id', '=', $id)->delete();
        
    }
    public function update(Request $request){
        DB::table('levels')
            ->where('id', $request->id)
            ->update(['name' =>$request->name]);

    }
    
}

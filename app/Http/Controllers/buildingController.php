<?php

namespace App\Http\Controllers;
use App\Building;
use Illuminate\Http\Request;
use App\Level;
use App\Area;
use App\Table;
use DB; 
class buildingController extends Controller
{
    
    public function getBuildings(){
        return Building::all();
    }
    public function showLevels(Request $request){
        $building_id=$request->building_id;
        
        $levels=Building::find($building_id)->levels()->get();
        return $levels;
    }
    
    public function delete(Request $request){
        $id=$request->id;
        
        $levels=Building::find($id)->levels();
        
        foreach ($levels->get() as $level){
            $level_id=$level->id;
            $areas=Level::find($level_id)->areas();

            foreach ($areas->get() as $area){
                $area_id=$area->id;
                
                
                $tables=Area::find($area_id)->tables();
                $tables->delete();
            }
            
            
            $areas->delete();
        }
        $levels->delete();
        DB::table('buildings')->where('id', '=', $id)->delete();
        
    }
    
    public function store(Request $request)
    {
        $building=new Building;

        $building->name=$request->name;
        
        $building->save();
        return ["response"=>"<p class='success--text'>Building was created</p>","status"=>1];
    }

   
  
}

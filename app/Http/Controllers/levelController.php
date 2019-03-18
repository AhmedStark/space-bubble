<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
class levelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('level.create');
    }
    public function showLevels(){
        return view('levels.index');
    }

    public function showAreas(Request $request){
        $level_id=$request->level_id;
        
        $areas=Level::find($level_id)->areas()->get();
        return $areas;
    }
    


    public function store(Request $request)
    {
        $level=new Level;

        $level->building_id= $request->building_id;
        $level->name=$request->name;

        $level->save();
    }

    
}

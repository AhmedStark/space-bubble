<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
class areaController extends Controller
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
        return view('area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area=new Area;

        $area->level_id= $request->level_id;
        $area->name=$request->name;

        $area->save();
    }

    public function showAreas(){
        return view('areas.index');
    }

    public function showTables(Request $request){
        $area_id=$request->area_id;
        
        $tables=Area::find($area_id)->tables()->get();
        return $tables;
    }

    
}

<?php

namespace App\Http\Controllers;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends Controller
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
        return view('admin.create');
    }

    public function login()
    {
        return view('admin.login');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique',                //still working on this 
        ]);
        $credentials = [
            'name'=> $request->name,
            'email'    => $request->email,
            'password' => $request->pwd,
        ];
        
        $user = Sentinel::registerAndActivate($credentials);
        
    }
    public function control(){
        return view('admin.control');
    }

    public function checklogin(Request $request){

        $credentials = [
            'email'    => $request->email,
            'password' => $request->pwd,
        ];
        
        Sentinel::authenticate($credentials);
        return redirect('admin/control');
    }

    
}

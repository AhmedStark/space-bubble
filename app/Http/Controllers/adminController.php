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
    public static function store(Request $request)
    {
        
        
    }
    

    public function checklogin(Request $request){
        $credentials = [
            'email'    => $request->email,
            'password' => $request->pwd,
        ];
        
        
        if($user=Sentinel::authenticate($credentials)){
            return redirect('/admin/dashboard');
        };
        
        return redirect()->back()->with(['response'=>"<p class='error--text'>incorrect password or user name</p>"]);
    }

    public function logout(){
        Sentinel::logout();
        return redirect("/admin");
    }
    
}

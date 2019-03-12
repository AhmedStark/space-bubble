<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/map',function(){
    return view('map');
});

Route::get('/admin/dashboard',function(){
    
    return view('admin.dashboard');
});
Route::get('/areas',function(){
    
    return  [
        ['desks'=>20,'taken_desks'=>12],
        ['desks'=>20,'taken_desks'=>17],
        ['desks'=>20,'taken_desks'=>20],
        ['desks'=>20,'taken_desks'=>11],
    ];
});

Route::get('/areas/{id}',function($id){
    
    return  [
        'areas'=>[
        ['name'=>"Lab 1",'id'=>1,'desks'=>20,'takenDesks'=>12,"direct"=>"o"],
        ['name'=>"Lab 2",'id'=>2,'desks'=>20,'takenDesks'=>20,"direct"=>"b"],
        ['name'=>"Lab 3",'id'=>3,'desks'=>30,'takenDesks'=>28,"direct"=>"r"],
        ['name'=>"Lab 4",'id'=>4,'desks'=>20,'takenDesks'=>07,"direct"=>"q"],
        ['name'=>"Lab 5",'id'=>5,'desks'=>26,'takenDesks'=>20,"direct"=>"5"],
        ['name'=>"Lab 6",'id'=>6,'desks'=>25,'takenDesks'=>20,"direct"=>"w"],
        ['name'=>"Lab 7",'id'=>7,'desks'=>30,'takenDesks'=>15,"direct"=>"s"],
        ['name'=>"Lab 8",'id'=>8,'desks'=>20,'takenDesks'=>0,"direct"=>"r"],
        ['name'=>"Lab 9",'id'=>9,'desks'=>20,'takenDesks'=>20,"direct"=>null],
        ],
        'id'=>$id
    ];
});

Route::get('big-map',function(){
    return view('big-map');
});


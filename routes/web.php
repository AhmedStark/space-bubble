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
Route::get('/map/{id}',function(){
    return view('map');
});

Route::get('/admin/dashboard',function(){

    return view('admin.dashboard');
});
//don't use this structure
Route::get('admin/create','adminController@create');
Route::post('admin/create','adminController@store');

Route::get('admin/login','adminController@login');
Route::post('admin/login','adminController@checklogin');



Route::get('admin/control','adminController@control');

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
        ['name'=>"Lab 1",'id'=>1,'desks'=>20,'takenDesks'=>2,"direct"=>"1"],
        ['name'=>"Lab 2",'id'=>2,'desks'=>20,'takenDesks'=>20,"direct"=>"1"],
        ['name'=>"Lab 3",'id'=>3,'desks'=>30,'takenDesks'=>28,"direct"=>"1"],
        ['name'=>"Lab 4",'id'=>4,'desks'=>20,'takenDesks'=>07,"direct"=>"1"],
        ['name'=>"Lab 5",'id'=>5,'desks'=>26,'takenDesks'=>20,"direct"=>"1"],
        ['name'=>"Lab 6",'id'=>6,'desks'=>25,'takenDesks'=>20,"direct"=>"1"],
        ['name'=>"Lab 7",'id'=>7,'desks'=>30,'takenDesks'=>15,"direct"=>"1"],
        ['name'=>"Lab 8",'id'=>8,'desks'=>20,'takenDesks'=>0,"direct"=>"1"],
        ['name'=>"Lab 9",'id'=>9,'desks'=>20,'takenDesks'=>20,"direct"=>null],
        ],
        'id'=>$id
    ];
});
Route::get('/buildings/{id}/levels',function(){
    return ['levels'=>[
        ['name'=>"Basement",'id'=>1],
        ['name'=>"Ground",'id'=>2],
        ['name'=>"Level 1",'id'=>3],
        ['name'=>"Level 2",'id'=>4],
    ]];
});
Route::get('/levels/{id}/areas',function(){
    return ['areas'=>[
        ['name'=>"South",'id'=>1],
        ['name'=>"North",'id'=>2],
        ['name'=>"West",'id'=>3],
    ]];
});



Route::get('big-map',function(){
    return view('big-map');
});
Route::get('/buildings','buildingController@getBuildings');

//Route::post('/main','buildingController@showLevels');
Route::post('/buildings/create','buildingController@store');

Route::post('/level','levelController@showAreas');
Route::post('/area','areaController@showTables');

Route::get('/count',"areaController@totalTables");

Route::get('/countTaken',"areaController@totalTakenTables");

Route::get('/deleteTable','tableController@delete');

Route::get('/deleteArea','areaController@delete');
Route::get('/deleteLevel','levelController@delete');
Route::get('/deleteBuilding','buildingController@delete');
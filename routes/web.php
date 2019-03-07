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


<?php

use App\Http\Middleware\AdminAuth;


Route::group(['middleware' => ['AdminAuth']], function () {
    Route::post('/level/{id}/delete','levelController@delete');
    Route::post('/deleteLevel','levelController@delete');

    Route::post('/areas/create','areaController@store');
    Route::get('/areas/create','areaController@store');

    Route::post("/level/{id}/edit",'levelController@changeMap');
    Route::post("/area/{id}/edit",'areaController@update');
    Route::post("/admin/change-main-map",'MainMapController@update');

    Route::post('/buildings/create','buildingController@store');
    Route::get('/buildings/create','buildingController@store');
    
    Route::post('/levels/create','levelController@store');
    Route::get('/levels/create','levelController@store');

    Route::get('/deleteTable','tableController@create');
    Route::post('/deleteTable','tableController@delete');
    
    Route::get('/area/{id}/data','areaController@getHistory');
    Route::get('/deleteArea','areaController@delete');
    Route::post('/deleteArea','areaController@delete');
    
    Route::get('/deleteBuilding','buildingController@delete');
    Route::get('updateBuilding','buildingController@update');
    
    Route::post('/levels/{id}/delete','levelController@delete');
    Route::post('/buildings/{id}/delete','buildingController@delete');
    Route::post('building/{id}/edit','buildingController@update');

    Route::get('updateArea','areaController@update');
    Route::get('updateLevel','levelController@update');
    Route::get('/admin/area-history','areaController@history');

    Route::get('moveTable','tableController@moveTo');
    Route::post('moveTable','tableController@moveTo');
    Route::get('admin/area/{id}','areaController@editArea');

    Route::get('/table','tableController@store');
    Route::post('/table','tableController@store');

    Route::get('/admin/dashboard',function(){

        return view('admin.dashboard');
    });
    Route::get('/admin/help',function(){

        return view('admin.help');
    });

    Route::post('/logout','adminController@logout');


    Route::get('/admin/download-data','areaController@downloadRecords');
});
Route::get('/dl/{id}','areaController@getHistory');
Route::get('/map/{id}','levelController@getMap');

Route::get("/store-many","tableController@storeMany");
Route::get("/busy-tables/{id}/{number}","tableController@makeTablesTaken");

Route::group(['middleware' => ['AlreadyAuth']], function () {

    Route::get('admin/','adminController@login');

});
Route::post('admin/login','adminController@checklogin');
Route::get('admin/login','adminController@checklogin');






Route::get('/buildings/{id}/levels','buildingController@showLevels');
Route::get('/levels/{id}/areas','levelController@showAreas');


Route::get('/',function(){
    return view('big-map');
});
Route::get('/big-map',function(){
    return view('big-map');
});
Route::get('/buildings','buildingController@getBuildings');

//Route::post('/main','buildingController@showLevels');

Route::post('/level','levelController@showAreas');
Route::get('/area/{id}/tables','areaController@showTables');

Route::get('/count',"areaController@totalTables");
Route::post('/count',"areaController@totalTables");

Route::get('/countTaken',"areaController@totalTakenTables");
Route::post('/countTaken',"areaController@totalTakenTables");


Route::get('createUser','adminController@store');



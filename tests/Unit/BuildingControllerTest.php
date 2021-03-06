<?php

namespace Tests\Unit;
use WithoutMiddleware;

use App\Building;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;

class BuildingControllerTest extends TestCase
{

    public $ID;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateBuilding()
    {
        $this->withoutMiddleware();
        $data = [
            'name' => "WS",
            
        ];
        $response = $this->json('GET', '/buildings/create',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => $data]);
        $this->ID=DB::table('buildings')->orderBy('id','desc')->first()->id;
    }

    public function testDeleteBuilding()
    {
        $this->withoutMiddleware();
        $this->ID=DB::table('buildings')->orderBy('id','desc')->first()->id;
        $request = [
            'id' => $this->ID,
        ];
        $this->ID=DB::table('buildings')->orderBy('id','desc')->first()->id;
        $response = $this->json('POST', "/buildings/".$this->ID."/delete",$request);
        $checkBuilding=DB::table('buildings')->where('id', '=', $this->ID)->count();
        $checkLevels=DB::table('levels')->where('building_id', '=', $request['id'])->count();
        $Levels=DB::table('levels')->where('building_id', '=', $request['id'])->get();
        foreach($Levels as $level){
            $level_id=$level->id;
            $checkAreas=Level::find($level_id)->areas()->count();
            $Areas=Level::find($level_id)->areas()->get();
            foreach($Areas as $area){
                $area_id=$area->id;
                $checkTables=Area::find($area_id)->tables()->count();
                $this->assertTrue($checkTables==0);
            }
            $this->assertTrue($checkAreas==0);
        }
        $this->assertTrue($checkBuilding==0);
        $this->assertTrue($checkLevels==0);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['request' => $request]);
    }
}

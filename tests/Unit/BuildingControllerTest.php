<?php

namespace Tests\Unit;

use App\Building;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $data = [
            'name' => "WS",
            
        ];
        $building = factory(Building::class)->create();
        $response = $this->json('POST', '/buildings/create',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Building Created!"]);
        $response->assertJson(['data' => $data]);
        $this->ID=$response->id;
    }

    public function testDeleteBuilding()
    {
        $request = [
            'id' => $ID,
        ];
        
        
        
        $response = $this->json('GET', '/deleteBuilding',$request);
        $checkBuilding=DB::table('buildings')->where('id', '=', $request->id)->count();
        $checkLevels=DB::table('levels')->where('building_id', '=', $request->id)->count();
        $Levels=DB::table('levels')->where('building_id', '=', $request->id)->get();
        foreach($LevelsInsideBuilding as $level){
            $level_id=$level->id;
            $checkAreas=Level::find($level_id)->areas()->count();
            $Areas=Level::find($level_id)->areas()->get();
            foreach($Areas as $area){
                $area_id=$area->id;
                $checkTables=Area::find($area_id)->tables()->count();
                assertTrue($checkTables==0);
            }
            assertTrue($checkAreas==0);
        }
        assertTrue($checkBuilding==0);
        assertTrue($checkLevels==0);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Building deleted!"]);
        $response->assertJson(['request' => $request]);
    }
}

<?php

namespace Tests\Unit;
use DB;
use App\Area;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class LevelControllerTest extends TestCase
{
    
    public $ID;

    public function testCreateLevel()
    {
        $data = [
            'building_id' => 1,
            'name'=>"level 1",

            
        ];
        $response = $this->json('POST', '/levels/create',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => $data]);
        $this->ID=DB::table('levels')->orderBy('id','desc')->first()->id;
    }

    public function testDeleteLevel()
    {
        $this->ID=DB::table('levels')->orderBy('id','desc')->first()->id;
        
        $request = [
            'id' => $this->ID,
        ];
        
        
        
        $response = $this->json('POST', '/level/'.$request['id'].'/delete',$request);
        $checkLevels=DB::table('levels')->where('id', '=', $request['id'])->count();
        $checkAreas=DB::table('areas')->where('level_id', '=', $request['id'])->count();
        $Areas=DB::table('areas')->where('level_id', '=', $request['id'])->get();
        foreach($Areas as $Area)
        {
            $area_id=$Area->id;
            $checkTables=Area::find($area_id)->tables()->count();
            $this->assertTrue($checkTables==0);
        }
        $this->assertTrue($checkAreas==0);
        $this->assertTrue($checkLevels==0);

        
        
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['request' => $request]);
    }
}

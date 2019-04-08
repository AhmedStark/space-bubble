<?php

namespace Tests\Unit;
use App\Table;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\database\factories\TableFactory;
class TableControllerTests extends TestCase
{

    public function testCreateTable(){
        $data = [
            'area_id' => 1,
            'taken' => 0,
            
        ];
        $table = factory(Table::class)->create();
        $response = $this->json('POST', '/table',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Table Created!"]);
        $response->assertJson(['data' => $data]);
        //add assertion of whether it exists in DB??
    }
    public function testDeleteTable(){
        $request = [
            'id' => 1,
        ];
        $table = factory(Table::class)->create();
        $response = $this->json('GET', '/deleteTable',$request);
        $checkTable=DB::table('tables')->where('id', '=', $request->id)->count();
        assertTrue($checkTable==0);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Table deleted!"]);
        $response->assertJson(['request' => $request]);
        
    }
}

<?php

namespace Tests\Unit;
use App\Table;
use App\Area;
use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\database\factories\TableFactory;
class TableControllerTests extends TestCase
{

    public $ID;

    public function testCreateTable(){
        $data = [
            'area_id' => 1,
            'taken' => 0,
            
        ];
        $table = factory(Table::class)->create();
        $response = $this->json('POST', '/table',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => $data]);
        $this->ID=DB::table('tables')->orderBy('id','desc')->first()->id;
    }
    public function testDeleteTable(){
        $request = [
            'id' => $this->ID,
        ];
        $table = factory(Table::class)->create();
        $response = $this->json('GET', '/deleteTable',$request);
        $checkTable=DB::table('tables')->where('id', '=', $request['id'])->count();
        $this->assertTrue($checkTable==0);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        
    }
    public function testMoveTo(){
        $request=[
            'area_id'=>2,
            'table_id'=>$this->ID,
        ];
        $areas=factory(Area::class)->create();
        
        
        $response=$this->json('GET','/moveTable',$request);
        $this->assertTrue(!Table::find($this->ID));
        

    }
}

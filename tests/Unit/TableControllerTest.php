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
        $response->assertJson(['message' => "Product Created!"]);
        $response->assertJson(['data' => $data]);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}

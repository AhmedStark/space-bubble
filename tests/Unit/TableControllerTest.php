<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableControllerTest extends TestCase
{

    public function testCreateTable(){
        $data = [
            'area_id' => 1,
            'token' => 'qwert12345qwert1234512345',
            'taken' => 0,
            
        ];
        $table = factory(\App\Table::class)->create();
        $response = $this->actingAs($table, 'api')->json('POST', '/api/tableController',$data);
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

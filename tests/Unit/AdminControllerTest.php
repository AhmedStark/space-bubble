<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $request=[
            'email'=>'ahmed@gmail.com',
            'pwd'=>'123456789',
        ];

        $response=$this->json('POST', 'admin/login',$request);
        

    }
}

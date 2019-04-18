<?php

namespace Tests\Unit;
use WithoutMiddleware;


use Sentinel;
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
            'email'=>'bilal@gmail.com',
            'pwd'=>'a123456',
        ];

        $response=$this->json('POST', '/admin/login',$request);

        $this->assertTrue(Sentinel::check()!=null);

    }

    public function test_console_command()
{
    $this->artisan('question')
         ->expectsQuestion('What is your first name?', 'Tupac')
         ->expectsQuestion('What is your last name?', 'Shakur')
         ->expectsQuestion('What is your email?', 'tupac@gmail.com')
         ->expectsQuestion('What is your password?', 'tupacisgreate');

}
}

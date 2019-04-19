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
    public $user;
        public $first_name= "xyzx";
        public $last_name= "xyzx";
        public $email= "xyz.x@gmail.com";
        public $password="12345678";
        
        public function test_console_command()
    {
        echo "name :".$this->first_name." ". $this->last_name." ".$this->password." ".$this->email;
        $this->artisan('mkAdmin')
             ->expectsQuestion('What is your first name?', $this->first_name)
             ->expectsQuestion('What is your last name?', $this->last_name)
             ->expectsQuestion('What is your email?', $this->email)
             ->expectsQuestion('What is your password?', $this->password);
    
    }
    public function testLogin()
    { 
        $request=[
            'email'=>$this->email,
            'pwd'=>$this->password,
        ];

        $response=$this->json('POST', '/admin/login',$request);

        $this->assertTrue(Sentinel::check()!=null);

    }

}

<?php

namespace App\Console\Commands;
use App\adminController;
use Illuminate\Console\Command;
use Validator;
use Sentinel;



class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mkAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name=$this->ask("What is your first name?");
        $surname=$this->ask("What is your last name?");

        $email=$this->ask("What is your email?");
        $pwd=$this->secret("What is your password?");
        $data=[
            'first_name'=>$name,
            'last_name'=>$surname,
            'email'=>$email,
            'password'=>$pwd,   
        ];

        $validator = Validator::make($data, [ "first_name" => "required|min:3", "email"=>"required|unique:users","password"=>"min:4" ]);
        if ($validator->fails()){
            echo "Try again :(";
            return"ass";
        }
                
        $user = Sentinel::registerAndActivate($data);
    }
}

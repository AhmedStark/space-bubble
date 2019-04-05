<?php

use Illuminate\Database\Seeder;

class TableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3; $i++) { 
            DB::table('tables')->insert([
                'area_id' =>1,
                'token' => Str::random(25),
                'taken' => 0]);
        }
    }
    
}

<?php

use Faker\Generator as Faker;
use App\Table;
$factory->define(Table::class, function (Faker $faker) {
    return [
        "area_id"=>1,
        'token'=> str_random(25), 
    ];
});

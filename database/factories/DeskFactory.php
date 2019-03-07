<?php

use Faker\Generator as Faker;
use App\Desk;
use App\Area;
$factory->define(Desk::class, function (Faker $faker) {
    return [
        "area_id"=>factory(Area::class),
        'token'=> str_random(120),
    ];
});

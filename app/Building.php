<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public function level(){
        $this->hasMany(Level::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function area(){
        return $this->hasMany(Area::class);
    }
    public function building(){
        return $this->belongsTo(Building::class);
    }
}

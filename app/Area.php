<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function desks(){
        return $this->hasMany(Desk::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function tables(){
        return $this->hasMany(Table::class);
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }
}
 
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Area;
class Desk extends Model
{
    public function area(){
        return $this->belongsTo(Area::class);
    }
}

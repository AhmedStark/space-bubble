<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Area;
class Table extends Model
{
    public function area(){
        return $this->belongsTo(Area::class);
    }
}

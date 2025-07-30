<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NepaliMonth extends Model
{
    public function maghFaram(){
        return $this->hasMany(MaghFaram::class,'month_id');
    }
}

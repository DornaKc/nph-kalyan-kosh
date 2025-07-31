<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeSourceCategory extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incomeSources()
    {
        return $this->hasMany(IncomeSource::class, 'category_id');
    }
}

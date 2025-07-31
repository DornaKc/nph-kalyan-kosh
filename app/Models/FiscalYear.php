<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    public function maghFarams()
    {
        return $this->hasMany(MaghFaram::class, 'fiscal_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'fiscal_id');
    }
}

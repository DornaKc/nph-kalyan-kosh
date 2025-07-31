<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    // protected $guarded = [
    //     'fiscal_id',
    //     'budget_title',
    //     'budget_type',
    //     'allocated_amount',
    //     'expenditure',
    //     'balance',
    //     'remarks',
    //     'date',
    //     'slug'
    // ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_id', 'id');
    }

}

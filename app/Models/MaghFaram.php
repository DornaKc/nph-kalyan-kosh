<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaghFaram extends Model
{
    protected $guarded = [];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class,'fiscal_id');
    }

    public function months()
    {
        return $this->belongsTo(NepaliMonth::class,'month_id');
    }

    public function items(){
        return $this->hasMany(MaghItem::class,'magh_faram_id');
    }
}

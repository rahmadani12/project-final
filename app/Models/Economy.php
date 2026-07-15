<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    protected $fillable = [
        'country_id',
        'gdp',
        'inflation',
        'unemployment',
        'export_value',
        'import_value',
        'growth',
        'year',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
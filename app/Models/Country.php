<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
        protected $fillable = [
        'name',
        'code',
        'capital',
        'currency',
        'region',
        'subregion',
        'population',
        'flag',
        'latitude',
        'longitude',
    ];
}
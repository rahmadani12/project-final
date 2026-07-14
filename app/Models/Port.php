<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = [
        'name',
        'country',
        'city',
        'type',
        'latitude',
        'longitude',
        'status',
    ];
}
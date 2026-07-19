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

    public function routesFrom()
    {
        return $this->hasMany(ShippingRoute::class,'origin_port_id');
    }

    public function routesTo()
    {
        return $this->hasMany(ShippingRoute::class,'destination_port_id');
    }
}
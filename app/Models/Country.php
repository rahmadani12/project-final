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

    public function weatherData()
    {
        return $this->hasMany(WeatherData::class);
    }

    public function economies()
    {
        return $this->hasMany(Economy::class);
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function riskScores()
    {
        return $this->hasMany(RiskScore::class);
    }
    
}


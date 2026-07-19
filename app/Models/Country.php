<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',          // ISO2 (ID, JP, SG)
        'iso3',          // ISO3 (IDN, JPN, SGP)
        'capital',
        'currency',
        'region',
        'subregion',
        'population',
        'flag',
        'latitude',
        'longitude',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Weather
    public function weatherData()
    {
        return $this->hasMany(WeatherData::class);
    }

    // Economy
    public function economies()
    {
        return $this->hasMany(Economy::class);
    }

    // Currency
    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    // News
    public function news()
    {
        return $this->hasMany(News::class);
    }

    // Risk Score
    public function riskScores()
    {
        return $this->hasMany(RiskScore::class);
    }

    // Port
    public function ports()
    {
        return $this->hasMany(Port::class);
    }

    // Watchlists
    public function watchlists()
    {
        return $this->hasMany(Watchlist::class);
    }
}
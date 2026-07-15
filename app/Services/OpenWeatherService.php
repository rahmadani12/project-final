<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    public function getWeather($lat,$lon)
    {
        $response = Http::get(
            'https://api.openweathermap.org/data/2.5/weather',
            [
                'lat'=>$lat,
                'lon'=>$lon,
                'appid'=>config('services.openweather.key'),
                'units'=>'metric'
            ]
        );

        if($response->successful()){
            return $response->json();
        }

        return null;
    }
}
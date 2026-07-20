<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryService
{
    public function getCountries()
    {
        $response = Http::withToken(env('REST_COUNTRIES_API_KEY'))
            ->acceptJson()
            ->timeout(60)
            ->get('https://api.restcountries.com/countries/v5?limit=100');

        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        return $response->json('data');
    }
}
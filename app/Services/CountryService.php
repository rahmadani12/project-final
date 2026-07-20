<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryService
{
    public function getCountries()
    {
        $response = Http::acceptJson()
            ->timeout(60)
            ->get('https://restcountries.com/v3.1/all');

        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        return $response->json();
    }
}
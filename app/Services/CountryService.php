<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryService
{
    public function getCountries()
    {
        $path = base_path('database/data/countries.json');

        if (!file_exists($path)) {
            throw new \Exception('countries.json not found.');
        }

        return json_decode(file_get_contents($path), true);
    }
}
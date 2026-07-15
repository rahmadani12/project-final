<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    public function getRates($base = 'USD')
    {
        $response = Http::get(
            'https://v6.exchangerate-api.com/v6/' .
            config('services.exchangerate.key') .
            '/latest/' . $base
        );

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    public function search($keyword)
    {
        $response = Http::get(
            'https://gnews.io/api/v4/search',
            [
                'q' => $keyword,
                'lang' => 'en',
                'max' => 10,
                'apikey' => config('services.gnews.key'),
            ]
        );

        if ($response->successful()) {
            return $response->json();
        }

        dd([
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
    }
}
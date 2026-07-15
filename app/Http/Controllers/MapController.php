<?php

namespace App\Http\Controllers;

use App\Models\Country;

class MapController extends Controller
{
    public function index()
    {
        $countries = Country::with([
            'riskScores',
            'weatherData',
            'economies',
            'currencies'
        ])
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->orderBy('name')
        ->get();

        return view('map.index', compact('countries'));
    }
}
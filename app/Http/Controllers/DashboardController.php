<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Country;
use App\Models\Economy;
use App\Models\Port;
use App\Models\RiskScore;
use App\Models\WeatherData;

class DashboardController extends Controller
{
    public function index()
    {
        $countries = Country::count();
        $ports = Port::count();
        $weather = WeatherData::count();
        $economies = Economy::count();
        $news = News::count();

        $high = RiskScore::where('risk_level','High')->count();
        $medium = RiskScore::where('risk_level','Medium')->count();
        $low = RiskScore::where('risk_level','Low')->count();

        $topRisk = RiskScore::with('country')
                    ->orderByDesc('total_score')
                    ->take(10)
                    ->get();

        return view('dashboard.index', compact(
            'countries',
            'ports',
            'weather',
            'economies',
            'news',
            'high',
            'medium',
            'low',
            'topRisk'
        ));
    }
}
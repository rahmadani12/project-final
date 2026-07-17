<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Economy;
use App\Models\News;
use App\Models\Port;
use App\Models\RiskScore;
use App\Models\WeatherData;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $countryCount = Country::count();
        $weatherCount = WeatherData::count();
        $economyCount = Economy::count();
        $newsCount = News::count();
        $portCount = Port::count();

        // Risk Summary
        $highRisk = RiskScore::where('risk_level', 'High')->count();
        $mediumRisk = RiskScore::where('risk_level', 'Medium')->count();
        $lowRisk = RiskScore::where('risk_level', 'Low')->count();

        // Top Risk Countries
        $topRisk = RiskScore::with('country')
            ->orderByDesc('total_score')
            ->take(5)
            ->get();

        // Berita terbaru
        $latestNews = News::with('country')
            ->latest()
            ->take(5)
            ->get();

        // Negara terbaru
        $recentCountries = Country::latest()
            ->take(5)
            ->get();

        // Chart
        $chart = [
            $highRisk,
            $mediumRisk,
            $lowRisk
        ];

        // Map
        $mapCountries = Country::select(
            'name',
            'latitude',
            'longitude',
            'flag'
        )
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get();

        return view('dashboard.index', compact(
            'countryCount',
            'weatherCount',
            'economyCount',
            'newsCount',
            'portCount',
            'highRisk',
            'mediumRisk',
            'lowRisk',
            'topRisk',
            'latestNews',
            'recentCountries',
            'chart',
            'mapCountries'
        ));
    }
}
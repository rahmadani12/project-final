<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use App\Models\Article;
use App\Models\RiskScore;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'countryCount' => Country::count(),
            'highRisk'     => RiskScore::count(),
            'ports'        => Port::count(),
            'newsToday'    => Article::count(),
        ]);
    }
}
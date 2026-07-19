<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\RiskScore;
use App\Models\Port;
use App\Models\ShippingRoute;

class MapController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        $ports = Port::all();

        $routes = ShippingRoute::with([
            'originPort',
            'destinationPort'
        ])->get();

        $high = RiskScore::where('risk_level','High')->count();

        $medium = RiskScore::where('risk_level','Medium')->count();

        $low = RiskScore::where('risk_level','Low')->count();

        $total = Country::count();

        return view('map.index', compact(
            'countries',
            'ports',
            'routes',
            'high',
            'medium',
            'low',
            'total'
        ));
    }
}
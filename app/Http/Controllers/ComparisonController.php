<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\RiskScore;

class ComparisonController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::orderBy('name')->get();

        $selected = $request->input('countries', []);

        $comparison = RiskScore::with('country')
            ->whereIn('country_id', $selected)
            ->get();

        return view('comparison.index', compact(
            'countries',
            'comparison',
            'selected'
        ));
}
}
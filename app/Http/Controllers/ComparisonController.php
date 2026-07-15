<?php

namespace App\Http\Controllers;

use App\Models\RiskScore;

class ComparisonController extends Controller
{
    public function index()
    {
        $comparisons = \App\Models\RiskScore::with('country')
            ->orderByDesc('total_score')
            ->get();

        $labels = $comparisons->pluck('country.name');

        $scores = $comparisons->pluck('total_score');

        return view('comparison.index', compact(
            'comparisons',
            'labels',
            'scores'
        ));
    }
}
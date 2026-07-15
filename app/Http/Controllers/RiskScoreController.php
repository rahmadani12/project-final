<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Country;
use App\Models\Economy;
use App\Models\RiskScore;
use App\Models\WeatherData;
use Illuminate\Http\Request;

class RiskScoreController extends Controller
{
    /**
     * Menampilkan semua Risk Score
     */
    public function index()
    {
        $countries = Country::with('riskScores')
            ->orderBy('name')
            ->get();

        return view('risk-score.index', compact('countries'));
    }

    /**
     * Form create (belum digunakan)
     */
    public function create()
    {
        //
    }

    /**
     * Simpan manual (belum digunakan)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Detail Risk Score
     */
    public function show(RiskScore $riskScore)
    {
        return view('risk-score.show', compact('riskScore'));
    }

    /**
     * Form edit (belum digunakan)
     */
    public function edit(RiskScore $riskScore)
    {
        //
    }

    /**
     * Update manual (belum digunakan)
     */
    public function update(Request $request, RiskScore $riskScore)
    {
        //
    }

    /**
     * Hapus Risk Score
     */
    public function destroy(RiskScore $riskScore)
    {
        $riskScore->delete();

        return redirect()
            ->route('risk-score.index')
            ->with('success', 'Risk Score berhasil dihapus.');
    }

    /**
     * Hitung Risk Score berdasarkan
     * Weather + Economy + News
     */
    public function calculate(Country $country)
    {
        $weather = WeatherData::where('country_id', $country->id)->first();

        $economy = Economy::where('country_id', $country->id)
            ->latest()
            ->first();

        $newsCount = Article::where('country_id', $country->id)->count();

        $weatherScore = 0;
        $economyScore = 0;
        $newsScore = 0;

        /*
        =================================
        WEATHER SCORE
        =================================
        */

        if ($weather) {

            switch ($weather->weather) {

                case 'Storm':
                    $weatherScore += 50;
                    break;

                case 'Rain':
                    $weatherScore += 20;
                    break;

                case 'Cloudy':
                    $weatherScore += 10;
                    break;

                default:
                    $weatherScore += 0;
            }

            if ($weather->wind_speed > 40) {
                $weatherScore += 20;
            }

            if ($weather->temperature > 35) {
                $weatherScore += 10;
            }
        }

        /*
        =================================
        ECONOMY SCORE
        =================================
        */

        if ($economy) {

            if ($economy->inflation > 8) {

                $economyScore += 40;

            } elseif ($economy->inflation > 4) {

                $economyScore += 20;

            }

            if ($economy->growth < 2) {

                $economyScore += 30;

            }

            if ($economy->unemployment > 8) {

                $economyScore += 20;

            }

        }

        /*
        =================================
        NEWS SCORE
        =================================
        */

        $newsScore = $newsCount * 5;

        /*
        =================================
        TOTAL SCORE
        =================================
        */

        $total = $weatherScore + $economyScore + $newsScore;

        if ($total >= 80) {

            $level = 'High';

        } elseif ($total >= 40) {

            $level = 'Medium';

        } else {

            $level = 'Low';

        }

        RiskScore::updateOrCreate(

            [
                'country_id' => $country->id
            ],

            [
                'weather_score' => $weatherScore,
                'economy_score' => $economyScore,
                'news_score' => $newsScore,
                'total_score' => $total,
                'risk_level' => $level,
            ]

        );

        return redirect()
            ->route('risk-score.index')
            ->with('success', 'Risk Score berhasil dihitung.');
    }
}
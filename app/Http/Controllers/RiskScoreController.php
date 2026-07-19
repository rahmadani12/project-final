<?php

namespace App\Http\Controllers;

use App\Models\News;
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
        $riskScores = RiskScore::with('country')
            ->paginate(10);

        return view('risk-score.index', compact('riskScores'));
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

        $newsCount = News::where('country_id', $country->id)->count();

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

                case 'Clouds':
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

    public function calculateAll()
    {
        $countries = Country::all();

        foreach ($countries as $country) {

            $weather = WeatherData::where('country_id', $country->id)->first();

            $economy = Economy::where('country_id', $country->id)
                ->latest()
                ->first();

            $newsCount = News::where('country_id', $country->id)->count();

            $weatherScore = 0;
            $economyScore = 0;
            $newsScore = 0;

            /*
            ===========================
            WEATHER
            ===========================
            */

            if ($weather) {

                switch ($weather->weather) {

                    case 'Thunderstorm':
                        $weatherScore += 50;
                        break;

                    case 'Snow':
                        $weatherScore += 30;
                        break;

                    case 'Rain':
                        $weatherScore += 20;
                        break;

                    case 'Clouds':
                        $weatherScore += 10;
                        break;

                    case 'Mist':
                        $weatherScore += 10;
                        break;

                    default:
                        $weatherScore += 5;
                }

                if ($weather->temperature > 35)
                    $weatherScore += 10;

                if ($weather->wind_speed > 40)
                    $weatherScore += 20;
            }

            /*
            ===========================
            ECONOMY
            ===========================
            */

            if ($economy) {

                if ($economy->inflation > 8)
                    $economyScore += 30;

                elseif ($economy->inflation > 4)
                    $economyScore += 15;

                if ($economy->growth < 2)
                    $economyScore += 20;

                if ($economy->unemployment > 8)
                    $economyScore += 20;
            }

            /*
            ===========================
            NEWS
            ===========================
            */

            $newsScore = $newsCount * 5;

            /*
            ===========================
            TOTAL
            ===========================
            */

            $total = $weatherScore
                + $economyScore
                + $newsScore;

            if ($total >= 70) {

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
                    'risk_level' => $level
                ]

            );
        }

        return back()->with(
            'success',
            'Semua Risk Score berhasil dihitung.'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $weatherData = WeatherData::with('country')
            ->when($search, function ($query) use ($search) {
                $query->where('city', 'like', "%{$search}%")
                      ->orWhereHas('country', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10);

        return view('weather.index', compact('weatherData', 'search'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather' => 'required|string|max:100',
        ]);

        WeatherData::create([
            'country_id' => $request->country_id,
            'city' => $request->city,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'wind_speed' => $request->wind_speed,
            'weather' => $request->weather,
            'updated_at_weather' => now(),
        ]);

        return redirect()->route('weather.index')
            ->with('success', 'Data cuaca berhasil ditambahkan.');
    }

    public function show(WeatherData $weather)
    {
        return view('weather.show', compact('weather'));
    }

    public function edit(WeatherData $weather)
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.edit', compact('weather', 'countries'));
    }

    public function update(Request $request, WeatherData $weather)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city' => 'required',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather' => 'required',
        ]);

        $weather->update([
            'country_id' => $request->country_id,
            'city' => $request->city,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'wind_speed' => $request->wind_speed,
            'weather' => $request->weather,
            'updated_at_weather' => now(),
        ]);

        return redirect()
            ->route('weather.index')
            ->with('success', 'Data cuaca berhasil diperbarui.');
    }

    public function destroy(WeatherData $weather)
    {
        $weather->delete();

        return redirect()->route('weather.index')
            ->with('success', 'Data cuaca berhasil dihapus.');
    }

    public function refresh(WeatherData $weather)
    {
        $country = $weather->country;

        if (!$country) {
            return back()->with('error', 'Negara tidak ditemukan.');
        }

        if (!$country->latitude || !$country->longitude) {
            return back()->with('error', 'Koordinat negara belum tersedia.');
        }

        $response = Http::get(
            'https://api.open-meteo.com/v1/forecast',
            [
                'latitude' => $country->latitude,
                'longitude' => $country->longitude,
                'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m'
            ]
        );

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengambil data cuaca.');
        }

        $current = $response->json()['current'];

        $weather->update([

            'temperature' => $current['temperature_2m'],

            'humidity' => $current['relative_humidity_2m'],

            'wind_speed' => $current['wind_speed_10m'],

            'updated_at_weather' => now(),

        ]);

        return back()->with('success','Data cuaca berhasil diperbarui.');
    }

    }
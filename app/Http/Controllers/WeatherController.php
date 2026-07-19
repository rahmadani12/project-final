<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\WeatherData;
use App\Services\OpenWeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(OpenWeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * List Weather
     */
    public function index(Request $request)
    {
        $query = WeatherData::with('country');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('city', 'like', "%{$search}%")
                  ->orWhere('weather', 'like', "%{$search}%")
                  ->orWhereHas('country', function ($country) use ($search) {

                      $country->where('name', 'like', "%{$search}%");

                  });

            });

        }

        $weather = $query
            ->orderBy('country_id')
            ->paginate(10)
            ->withQueryString();

        return view('weather.index', compact('weather'));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.create', compact('countries'));
    }

    /**
     * Simpan
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city' => 'required',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather' => 'required'
        ]);

        WeatherData::create([
            'country_id' => $request->country_id,
            'city' => $request->city,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'wind_speed' => $request->wind_speed,
            'weather' => $request->weather,
            'updated_at_weather' => now()
        ]);

        return redirect()
            ->route('weather.index')
            ->with('success', 'Data weather berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(WeatherData $weather)
    {
        $weather->load('country');

        return view('weather.show', compact('weather'));
    }

    /**
     * Form Edit
     */
    public function edit(WeatherData $weather)
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.edit', compact('weather', 'countries'));
    }

    /**
     * Update Manual
     */
    public function update(Request $request, WeatherData $weather)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city' => 'required',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather' => 'required'
        ]);

        $weather->update([
            'country_id' => $request->country_id,
            'city' => $request->city,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'wind_speed' => $request->wind_speed,
            'weather' => $request->weather,
            'updated_at_weather' => now()
        ]);

        return redirect()
            ->route('weather.index')
            ->with('success', 'Data weather berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function destroy(WeatherData $weather)
    {
        $weather->delete();

        return redirect()
            ->route('weather.index')
            ->with('success', 'Data weather berhasil dihapus.');
    }

    /**
     * Update Semua Data dari API
     */
    public function updateAll()
    {
        $countries = Country::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        foreach ($countries as $country) {

            $data = $this->weatherService->getWeather(
                $country->latitude,
                $country->longitude
            );

            if (!$data) {
                continue;
            }

            WeatherData::updateOrCreate(

                [
                    'country_id' => $country->id
                ],

                [
                    'city' => $data['name'] ?? null,
                    'temperature' => $data['main']['temp'] ?? 0,
                    'humidity' => $data['main']['humidity'] ?? 0,
                    'wind_speed' => $data['wind']['speed'] ?? 0,
                    'weather' => $data['weather'][0]['main'] ?? '-',
                    'updated_at_weather' => now()
                ]

            );
        }

        return redirect()
            ->route('weather.index')
            ->with('success', 'Weather berhasil diperbarui.');
    }

    /**
     * Update Satu Negara
     */
    public function refresh(WeatherData $weather)
    {
        if (!$weather->country) {

            return back()->with(
                'error',
                'Country tidak ditemukan.'
            );

        }

        $country = $weather->country;

        $data = $this->weatherService->getWeather(
            $country->latitude,
            $country->longitude
        );

        if ($data) {

            $weather->update([

                'city' => $data['name'] ?? null,
                'temperature' => $data['main']['temp'] ?? 0,
                'humidity' => $data['main']['humidity'] ?? 0,
                'wind_speed' => $data['wind']['speed'] ?? 0,
                'weather' => $data['weather'][0]['main'] ?? '-',
                'updated_at_weather' => now()

            ]);

        }

        return back()->with(
            'success',
            'Weather berhasil diperbarui.'
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
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
        $search = $request->search;

        $weatherData = WeatherData::with('country')
            ->when($search, function ($query) use ($search) {
                $query->where('city', 'like', "%{$search}%")
                      ->orWhereHas('country', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('city')
            ->paginate(15);

        return view('weather.index', compact('weatherData', 'search'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.create', compact('countries'));
    }

    /**
     * Simpan manual
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
        return view('weather.show', compact('weather'));
    }

    /**
     * Form edit
     */
    public function edit(WeatherData $weather)
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.edit', compact('weather', 'countries'));
    }

    /**
     * Update manual
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
     * Update semua negara dari OpenWeather API
     */
    public function updateAll()
    {
        $countries = Country::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->limit(20) // sementara 20 dulu agar tidak melebihi batas API
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
                    'city' => $data['name'],
                    'temperature' => $data['main']['temp'],
                    'humidity' => $data['main']['humidity'],
                    'wind_speed' => $data['wind']['speed'],
                    'weather' => $data['weather'][0]['main'],
                    'updated_at_weather' => now()
                ]
            );
        }

        return redirect()
            ->route('weather.index')
            ->with('success', 'Weather berhasil diperbarui dari OpenWeather API.');
    }

    /**
     * Update satu negara dari API
     */
    public function refresh(WeatherData $weather)
    {
        $country = $weather->country;

        $data = $this->weatherService->getWeather(
            $country->latitude,
            $country->longitude
        );

        if ($data) {

            $weather->update([

                'city' => $data['name'],
                'temperature' => $data['main']['temp'],
                'humidity' => $data['main']['humidity'],
                'wind_speed' => $data['wind']['speed'],
                'weather' => $data['weather'][0]['main'],
                'updated_at_weather' => now()

            ]);
        }

        return back()->with(
            'success',
            'Weather berhasil diperbarui.'
        );
    }
}
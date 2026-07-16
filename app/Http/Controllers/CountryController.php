<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $countries = Country::when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%")
                      ->orWhere('iso3', 'like', "%{$search}%");

            })
            ->orderBy('name')
            ->paginate(15);

        return view('countries.index', compact('countries', 'search'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:countries,code|max:2',
            'iso3' => 'nullable|max:3',
        ]);

        Country::create([

            'name'       => $request->name,
            'code'       => strtoupper($request->code),
            'iso3'       => strtoupper($request->iso3),
            'capital'    => $request->capital,
            'currency'   => $request->currency,
            'region'     => $request->region,
            'subregion'  => $request->subregion,
            'population' => $request->population,
            'flag'       => $request->flag,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,

        ]);

        return redirect()
            ->route('countries.index')
            ->with('success', 'Country berhasil ditambahkan.');
    }

    public function import()
    {
        $countries = json_decode(
            file_get_contents(database_path('data/countries.json')),
            true
        );

        foreach ($countries as $item) {

            Country::updateOrCreate(

                [
                    'code' => $item['cca2']
                ],

                [

                    'name'       => $item['name']['common'] ?? '',
                    'code'       => $item['cca2'] ?? '',
                    'iso3'       => $item['cca3'] ?? '',
                    'capital'    => $item['capital'][0] ?? '',
                    'currency'   => isset($item['currencies'])
                        ? array_key_first($item['currencies'])
                        : '',
                    'region'     => $item['region'] ?? '',
                    'subregion'  => $item['subregion'] ?? '',
                    'population' => $item['population'] ?? 0,
                    'flag'       => $item['flag'] ?? '',
                    'latitude'   => $item['latlng'][0] ?? null,
                    'longitude'  => $item['latlng'][1] ?? null,

                ]

            );

        }

        return redirect()
            ->route('countries.index')
            ->with('success', 'Data negara berhasil diimport.');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|max:2|unique:countries,code,' . $country->id,
            'iso3' => 'nullable|max:3',
        ]);

        $country->update([

            'name'       => $request->name,
            'code'       => strtoupper($request->code),
            'iso3'       => strtoupper($request->iso3),
            'capital'    => $request->capital,
            'currency'   => $request->currency,
            'region'     => $request->region,
            'subregion'  => $request->subregion,
            'population' => $request->population,
            'flag'       => $request->flag,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,

        ]);

        return redirect()
            ->route('countries.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()
            ->route('countries.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
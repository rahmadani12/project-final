<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $countries = Country::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(15);

        return view('countries.index', compact('countries', 'search'));
    }

    public function import()
    {
        $countries = json_decode(
            file_get_contents(database_path('data/countries.json')),
            true
        );

        Country::truncate();

        foreach ($countries as $item) {

            Country::create([

                'name'       => $item['name']['common'] ?? '',
                'code'       => $item['cca2'] ?? '',
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

            ]);
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
        $country->update($request->all());

        return redirect()->route('countries.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
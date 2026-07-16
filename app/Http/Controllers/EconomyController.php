<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Economy;
use App\Services\EconomyService;
use Illuminate\Http\Request;

class EconomyController extends Controller
{
    protected $economyService;

    public function __construct(EconomyService $economyService)
    {
        $this->economyService = $economyService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $economies = Economy::with('country')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('country', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('economy.index', compact('economies', 'search'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('economy.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id'   => 'required|exists:countries,id',
            'gdp'          => 'nullable|numeric',
            'inflation'    => 'nullable|numeric',
            'unemployment' => 'nullable|numeric',
            'export_value' => 'nullable|numeric',
            'import_value' => 'nullable|numeric',
            'growth'       => 'nullable|numeric',
            'year'         => 'required',
        ]);

        Economy::create($request->all());

        return redirect()
            ->route('economy.index')
            ->with('success', 'Data ekonomi berhasil ditambahkan.');
    }

    public function show(Economy $economy)
    {
        return view('economy.show', compact('economy'));
    }

    public function edit(Economy $economy)
    {
        $countries = Country::orderBy('name')->get();

        return view('economy.edit', compact('economy', 'countries'));
    }

    public function update(Request $request, Economy $economy)
    {
        $request->validate([
            'country_id'   => 'required|exists:countries,id',
            'gdp'          => 'nullable|numeric',
            'inflation'    => 'nullable|numeric',
            'unemployment' => 'nullable|numeric',
            'export_value' => 'nullable|numeric',
            'import_value' => 'nullable|numeric',
            'growth'       => 'nullable|numeric',
            'year'         => 'required',
        ]);

        $economy->update($request->all());

        return redirect()
            ->route('economy.index')
            ->with('success', 'Data ekonomi berhasil diperbarui.');
    }

    public function destroy(Economy $economy)
    {
        $economy->delete();

        return redirect()
            ->route('economy.index')
            ->with('success', 'Data ekonomi berhasil dihapus.');
    }

    /**
     * Update data ekonomi dari World Bank API
     */
    public function updateApi()
    {
        $countries = Country::whereNotNull('iso3')->get();

        foreach ($countries as $country) {

            $economy = $this->economyService->getEconomy($country->iso3);

            if (!$economy) {
                continue;
            }

            Economy::updateOrCreate(

                [
                    'country_id' => $country->id,
                    'year' => $economy['year'],
                ],

                [
                    'gdp'            => $economy['gdp'],
                    'inflation'      => $economy['inflation'],
                    'unemployment'   => $economy['unemployment'],
                    'export_value'   => $economy['export_value'],
                    'import_value'   => $economy['import_value'],
                    'growth'         => $economy['growth'],
                ]

            );
        }

        return redirect()
            ->route('economy.index')
            ->with('success', 'Data Economy berhasil diperbarui dari World Bank API.');
    }
}
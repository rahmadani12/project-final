<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Economy;
use Illuminate\Http\Request;

class EconomyController extends Controller
{
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
            'country_id'    => 'required|exists:countries,id',
            'gdp'           => 'required|numeric',
            'inflation'     => 'required|numeric',
            'unemployment'  => 'required|numeric',
            'export_value'  => 'required|numeric',
            'import_value'  => 'required|numeric',
            'growth'        => 'required|numeric',
            'year'          => 'required',
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
            'country_id'    => 'required|exists:countries,id',
            'gdp'           => 'required|numeric',
            'inflation'     => 'required|numeric',
            'unemployment'  => 'required|numeric',
            'export_value'  => 'required|numeric',
            'import_value'  => 'required|numeric',
            'growth'        => 'required|numeric',
            'year'          => 'required',
        ]);

        $economy->update($request->all());

        return redirect()->route('economy.index')
            ->with('success', 'Data ekonomi berhasil diperbarui.');
    }

    public function destroy(Economy $economy)
    {
        $economy->delete();

        return redirect()->route('economy.index')
            ->with('success', 'Data ekonomi berhasil dihapus.');
    }
}
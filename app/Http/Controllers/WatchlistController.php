<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlists = Watchlist::with([
            'country.riskScores',
            'country.weatherData',
            'country.news'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'watchlist.index',
            compact('watchlists')
        );
    }

    public function store(Country $country)
    {
        Watchlist::create([
            'user_id'    => Auth::id(),
            'country_id' => $country->id,
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Negara berhasil ditambahkan ke Watchlist.');
    }

    public function destroy(Watchlist $watchlist)
    {
        $watchlist->delete();

        return back()->with(
            'success',
            'Watchlist berhasil dihapus.'
        );
    }

    public function show(Watchlist $watchlist)
    {
        $watchlist->load([
            'country',
            'country.weatherData',
            'country.economies',
            'country.riskScores',
        ]);

        return view('watchlist.show', compact('watchlist'));
    }
}
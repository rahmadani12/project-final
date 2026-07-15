<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    protected $exchangeRateService;

    public function __construct(ExchangeRateService $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    /**
     * List Currency
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $currencies = Currency::with('country')
            ->when($search, function ($query) use ($search) {

                $query->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhereHas('country', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });

            })
            ->orderBy('code')
            ->paginate(15);

        return view('currency.index', compact(
            'currencies',
            'search'
        ));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('currency.create', compact('countries'));
    }

    /**
     * Simpan manual
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'code' => 'required',
            'name' => 'required',
            'symbol' => 'nullable',
            'exchange_rate' => 'nullable|numeric'
        ]);

        Currency::create([
            'country_id' => $request->country_id,
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'symbol' => $request->symbol,
            'exchange_rate' => $request->exchange_rate,
            'updated_at_rate' => now()
        ]);

        return redirect()
            ->route('currency.index')
            ->with('success', 'Currency berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(Currency $currency)
    {
        return view('currency.show', compact('currency'));
    }

    /**
     * Form edit
     */
    public function edit(Currency $currency)
    {
        $countries = Country::orderBy('name')->get();

        return view('currency.edit', compact(
            'currency',
            'countries'
        ));
    }

    /**
     * Update manual
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'code' => 'required',
            'name' => 'required',
            'symbol' => 'nullable',
            'exchange_rate' => 'nullable|numeric'
        ]);

        $currency->update([
            'country_id' => $request->country_id,
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'symbol' => $request->symbol,
            'exchange_rate' => $request->exchange_rate,
            'updated_at_rate' => now()
        ]);

        return redirect()
            ->route('currency.index')
            ->with('success', 'Currency berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()
            ->route('currency.index')
            ->with('success', 'Currency berhasil dihapus.');
    }

    /**
     * Update semua currency dari API
     */
    public function updateRates()
    {
        $result = $this->exchangeRateService->getRates('USD');

        if (!$result || !isset($result['conversion_rates'])) {

            return back()->with(
                'error',
                'Gagal mengambil data Exchange Rate.'
            );
        }

        $rates = $result['conversion_rates'];

        $countries = Country::all();

        foreach ($countries as $country) {

            if (!$country->currency) {
                continue;
            }

            if (!isset($rates[$country->currency])) {
                continue;
            }

            Currency::updateOrCreate(

                [
                    'country_id' => $country->id
                ],

                [
                    'code' => $country->currency,
                    'name' => $country->currency,
                    'symbol' => $country->currency,
                    'exchange_rate' => $rates[$country->currency],
                    'updated_at_rate' => now()
                ]
            );

        }

        return redirect()
            ->route('currency.index')
            ->with(
                'success',
                'Exchange Rate berhasil diperbarui.'
            );
    }
}
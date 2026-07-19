@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow p-8">

    <h2 class="text-3xl font-bold mb-6">

        ⭐ Watchlist Detail

    </h2>

    @php
        $weather = $watchlist->country->weatherData->first();
        $economy = $watchlist->country->economies->first();
        $risk = $watchlist->country->riskScores->first();
    @endphp

    <div class="grid grid-cols-2 gap-5">

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Country</h6>
        <h4 class="font-bold">{{ $watchlist->country->name }}</h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Capital</h6>
        <h4 class="font-bold">{{ $watchlist->country->capital }}</h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Region</h6>
        <h4 class="font-bold">{{ $watchlist->country->region }}</h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Weather</h6>
        <h4 class="font-bold">
            {{ $weather->condition ?? '-' }}
        </h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Temperature</h6>
        <h4 class="font-bold">
            {{ $weather->temperature ?? '-' }} °C
        </h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">GDP</h6>
        <h4 class="font-bold">
            {{ $economy->gdp ?? '-' }}
        </h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Risk Score</h6>
        <h4 class="font-bold text-blue-600">
            {{ $risk->total_score ?? '-' }}
        </h4>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h6 class="text-gray-500">Risk Level</h6>

        @php
        $level = $risk->risk_level ?? null;
        @endphp

        @if($level == 'High')
            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">🔴 High</span>
        @elseif($level == 'Medium')
            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">🟡 Medium</span>
        @else
            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">🟢 Low</span>
        @endif
    </div>

</div>

<div class="mt-8">

    <a href="{{ route('watchlist.index') }}"
        class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg">

        ← Kembali

    </a>

</div>

@endsection
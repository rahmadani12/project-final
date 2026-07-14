@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    🌍 Global Supply Chain Risk Intelligence Platform
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-blue-600 text-white rounded-lg shadow p-6">
        <h2 class="text-lg">Countries</h2>

        <p class="text-4xl font-bold mt-3">
            {{ $countryCount }}
        </p>
    </div>

    <div class="bg-red-500 text-white rounded-lg shadow p-6">
        <h2 class="text-lg">High Risk</h2>

        <p class="text-4xl font-bold mt-3">
            {{ $highRisk }}
        </p>
    </div>

    <div class="bg-green-600 text-white rounded-lg shadow p-6">
        <h2 class="text-lg">Ports</h2>

        <p class="text-4xl font-bold mt-3">
            {{ $ports }}
        </p>
    </div>

    <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
        <h2 class="text-lg">News Today</h2>

        <p class="text-4xl font-bold mt-3">
            {{ $newsToday }}
        </p>
    </div>

</div>

<div class="grid grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-lg shadow p-6 h-80">
        <h2 class="font-bold text-xl mb-4">
            📈 GDP Trend
        </h2>

        <div class="h-56 flex items-center justify-center text-gray-400">
            Chart akan ditampilkan di sini
        </div>

    </div>

    <div class="bg-white rounded-lg shadow p-6 h-80">
        <h2 class="font-bold text-xl mb-4">
            ⛅ Weather Monitoring
        </h2>

        <div class="h-56 flex items-center justify-center text-gray-400">
            Data cuaca akan ditampilkan di sini
        </div>

    </div>

</div>

@endsection
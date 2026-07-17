@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🗺 Global Supply Chain Risk Map
</h1>

<div class="bg-white rounded-lg shadow p-4">

    <div id="map" style="height:700px;"></div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map').setView([20, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);

    // Icon Marker
    const greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25,41],
        iconAnchor: [12,41],
        popupAnchor: [1,-34]
    });

    const yellowIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25,41],
        iconAnchor: [12,41],
        popupAnchor: [1,-34]
    });

    const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25,41],
        iconAnchor: [12,41],
        popupAnchor: [1,-34]
    });

    @foreach($countries as $country)

        @php
            $risk = $country->riskScores->first();
            $weather = $country->weatherData->first();
            $economy = $country->economies->first();
            $currency = $country->currencies->first();
        @endphp

        .bindPopup(`
        <div style="min-width:260px">

        <h3><b>{{ $country->flag }} {{ $country->name }}</b></h3>

        <hr>

        <b>Capital</b> : {{ $country->capital }}<br>

        <b>Region</b> : {{ $country->region }}<br>

        <b>Population</b> : {{ number_format($country->population) }}<br>

        <hr>

        <b>Currency</b> :
        {{ $currency->code ?? '-' }}

        ({{ $currency->symbol ?? '-' }})

        <br>

        <hr>

        <b>Temperature</b> :

        {{ $weather->temperature ?? '-' }} °C

        <br>

        <b>Humidity</b> :

        {{ $weather->humidity ?? '-' }} %

        <br>

        <b>Weather</b> :

        {{ $weather->weather ?? '-' }}

        <br>

        <hr>

        <b>GDP</b> :

        {{ $economy->gdp ?? '-' }}

        <br>

        <b>Growth</b> :

        {{ $economy->growth ?? '-' }} %

        <br>

        <hr>

        <b>Risk Score</b> :

        {{ $risk->total_score ?? '-' }}

        <br>

        <b>Risk Level</b> :

        {{ $risk->risk_level ?? '-' }}

        </div>
        `)

    @endforeach

});

</script>

@endsection
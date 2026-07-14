@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🌦 Detail Weather
</h1>

<div class="bg-white shadow rounded-lg p-8">

    <table class="table-auto w-full">

        <tr>
            <td class="font-bold w-52 py-3">Country</td>
            <td>{{ $weather->country->name }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">City</td>
            <td>{{ $weather->city }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Temperature</td>
            <td>{{ $weather->temperature }} °C</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Humidity</td>
            <td>{{ $weather->humidity }} %</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Wind Speed</td>
            <td>{{ $weather->wind_speed }} km/h</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Weather</td>

            <td>

                @switch($weather->weather)

                    @case('Sunny')
                        ☀ Sunny
                        @break

                    @case('Cloudy')
                        ☁ Cloudy
                        @break

                    @case('Rain')
                        🌧 Rain
                        @break

                    @case('Storm')
                        ⛈ Storm
                        @break

                    @case('Snow')
                        ❄ Snow
                        @break

                    @default
                        {{ $weather->weather }}

                @endswitch

            </td>

        </tr>

        <tr>
            <td class="font-bold py-3">Last Update</td>
            <td>{{ $weather->updated_at_weather }}</td>
        </tr>

    </table>

    <div class="mt-8">

        <a href="{{ route('weather.index') }}"
           class="bg-gray-700 text-white px-5 py-2 rounded">

            ← Kembali

        </a>

    </div>

</div>

@endsection
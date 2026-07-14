@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ✏ Edit Weather
</h1>

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('weather.update',$weather) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label>Country</label>

            <select
                name="country_id"
                class="w-full border rounded p-2">

                @foreach($countries as $country)

                    <option
                        value="{{ $country->id }}"
                        {{ $weather->country_id==$country->id ? 'selected' : '' }}>

                        {{ $country->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label>City</label>

            <input
                type="text"
                name="city"
                value="{{ $weather->city }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label>Temperature</label>

            <input
                type="number"
                step="0.1"
                name="temperature"
                value="{{ $weather->temperature }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label>Humidity</label>

            <input
                type="number"
                name="humidity"
                value="{{ $weather->humidity }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label>Wind Speed</label>

            <input
                type="number"
                step="0.1"
                name="wind_speed"
                value="{{ $weather->wind_speed }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label>Weather</label>

            <select
                name="weather"
                class="w-full border rounded p-2">

                @foreach(['Sunny','Cloudy','Rain','Storm','Snow'] as $item)

                    <option
                        value="{{ $item }}"
                        {{ $weather->weather==$item ? 'selected' : '' }}>

                        {{ $item }}

                    </option>

                @endforeach

            </select>

        </div>

    </div>

    <div class="mt-6">

        <button
            class="bg-blue-600 text-white px-5 py-2 rounded">

            Update

        </button>

        <a href="{{ route('weather.index') }}"
           class="bg-gray-600 text-white px-5 py-2 rounded">

            Kembali

        </a>

    </div>

</form>

</div>

@endsection
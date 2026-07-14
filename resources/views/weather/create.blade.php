@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🌦 Tambah Data Weather
</h1>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded mb-4">
    <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white rounded-lg shadow p-6">

    <form action="{{ route('weather.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="block mb-2 font-semibold">Country</label>

                <select name="country_id"
                        class="w-full border rounded px-3 py-2"
                        required>

                    <option value="">-- Pilih Negara --</option>

                    @foreach($countries as $country)

                        <option value="{{ $country->id }}">

                            {{ $country->name }}

                        </option>

                    @endforeach

                </select>
            </div>

            <div>
                <label class="block mb-2 font-semibold">City</label>

                <input
                    type="text"
                    name="city"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Temperature (°C)</label>

                <input
                    type="number"
                    step="0.1"
                    name="temperature"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Humidity (%)</label>

                <input
                    type="number"
                    name="humidity"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Wind Speed (km/h)</label>

                <input
                    type="number"
                    step="0.1"
                    name="wind_speed"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Weather</label>

                <select
                    name="weather"
                    class="w-full border rounded px-3 py-2">

                    <option value="Sunny">☀ Sunny</option>
                    <option value="Cloudy">☁ Cloudy</option>
                    <option value="Rain">🌧 Rain</option>
                    <option value="Storm">⛈ Storm</option>
                    <option value="Snow">❄ Snow</option>

                </select>

            </div>

        </div>

        <div class="mt-8">

            <button
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

                Simpan

            </button>

            <a href="{{ route('weather.index') }}"
               class="bg-gray-600 text-white px-5 py-2 rounded">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection
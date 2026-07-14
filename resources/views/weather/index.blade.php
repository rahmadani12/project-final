@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🌦 Weather Management
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <a href="{{ route('weather.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            + Tambah Weather

        </a>

        <form method="GET" action="{{ route('weather.index') }}">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Kota / Negara..."
                class="border rounded px-3 py-2">

            <button
                class="bg-gray-800 text-white px-4 py-2 rounded">

                Cari

            </button>

        </form>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-100">

                <th class="border p-3">Country</th>
                <th class="border p-3">City</th>
                <th class="border p-3">Temperature</th>
                <th class="border p-3">Humidity</th>
                <th class="border p-3">Wind</th>
                <th class="border p-3">Weather</th>
                <th class="border p-3">Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($weatherData as $weather)

            <tr>

                <td class="border p-2">
                    {{ $weather->country->name ?? '-' }}
                </td>

                <td class="border p-2">
                    {{ $weather->city }}
                </td>

                <td class="border p-2">
                    {{ $weather->temperature }} °C
                </td>

                <td class="border p-2">
                    {{ $weather->humidity }} %
                </td>

                <td class="border p-2">
                    {{ $weather->wind_speed }} km/h
                </td>

                <td class="border p-2">
                    {{ $weather->weather }}
                </td>

                <td class="border p-2 text-center">

                    <a href="{{ route('weather.show',$weather) }}"
                       class="bg-blue-500 text-white px-2 py-1 rounded">

                        Detail

                    </a>

                    <a href="{{ route('weather.edit',$weather) }}"
                       class="bg-yellow-500 text-white px-2 py-1 rounded">

                        Edit

                    </a>

                    <a href="{{ route('weather.refresh', $weather) }}"
                    class="bg-green-600 text-white px-2 py-1 rounded">

                        Update API

                    </a>

                    <form
                        action="{{ route('weather.destroy',$weather) }}"
                        method="POST"
                        class="inline">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus data cuaca?')"
                            class="bg-red-600 text-white px-2 py-1 rounded">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center p-6">

                    Belum ada data cuaca.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="mt-6">

        {{ $weatherData->links() }}

    </div>

</div>

@endsection
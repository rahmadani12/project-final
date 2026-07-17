@extends('layouts.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-8">

    {{-- Header --}}
    <div class="flex items-center gap-8 mb-8">

        {{-- Bendera --}}
        <div class="flex-shrink-0">

            <img
                src="https://flagcdn.com/w320/{{ strtolower($country->code) }}.png"
                alt="{{ $country->name }}"
                class="w-40 h-28 object-cover rounded-xl border shadow-lg">

        </div>

        {{-- Informasi --}}
        <div>

            <h1 class="text-4xl font-bold text-[#800021]">
                {{ $country->name }}
            </h1>

            <p class="text-xl text-gray-500 mt-2">
                {{ $country->code }} • {{ $country->capital }}
            </p>

            <div class="mt-4 flex flex-wrap gap-3">

                <span class="px-4 py-2 bg-pink-100 text-[#800021] rounded-full">
                    🌍 {{ $country->region }}
                </span>

                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full">
                    📍 {{ $country->subregion }}
                </span>

                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full">
                    💰 {{ $country->currency }}
                </span>

            </div>

        </div>

    </div>

    {{-- Detail --}}
    <div class="grid grid-cols-2 gap-6">

        <div class="bg-gray-50 rounded-xl p-5">

            <h3 class="font-bold text-lg mb-4 text-[#800021]">
                Informasi Umum
            </h3>

            <table class="w-full">

                <tr>
                    <td class="py-2 font-semibold">Nama</td>
                    <td>{{ $country->name }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Kode</td>
                    <td>{{ $country->code }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Ibukota</td>
                    <td>{{ $country->capital }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Mata Uang</td>
                    <td>{{ $country->currency }}</td>
                </tr>

            </table>

        </div>

        <div class="bg-gray-50 rounded-xl p-5">

            <h3 class="font-bold text-lg mb-4 text-[#800021]">
                Lokasi
            </h3>

            <table class="w-full">

                <tr>
                    <td class="py-2 font-semibold">Region</td>
                    <td>{{ $country->region }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Sub Region</td>
                    <td>{{ $country->subregion }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Population</td>
                    <td>{{ number_format($country->population) }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Latitude</td>
                    <td>{{ $country->latitude }}</td>
                </tr>

                <tr>
                    <td class="py-2 font-semibold">Longitude</td>
                    <td>{{ $country->longitude }}</td>
                </tr>

            </table>

        </div>

    </div>

    <div class="mt-8">

        <a href="{{ route('countries.index') }}"
            class="bg-[#800021] hover:bg-[#881144] text-white px-6 py-3 rounded-xl transition">

            ← Kembali

        </a>

    </div>

</div>

@endsection
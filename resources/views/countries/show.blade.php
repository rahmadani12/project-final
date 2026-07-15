@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
🌍 Detail Country
</h1>

<div class="bg-white shadow rounded-lg p-6">

    <table class="table-auto w-full">

        <tr>
            <th class="border p-3 w-56 text-left">Nama Negara</th>
            <td class="border p-3">{{ $country->name }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Kode</th>
            <td class="border p-3">{{ $country->code }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Ibukota</th>
            <td class="border p-3">{{ $country->capital }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Mata Uang</th>
            <td class="border p-3">{{ $country->currency }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Region</th>
            <td class="border p-3">{{ $country->region }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Sub Region</th>
            <td class="border p-3">{{ $country->subregion }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Population</th>
            <td class="border p-3">
                {{ number_format($country->population) }}
            </td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Latitude</th>
            <td class="border p-3">{{ $country->latitude }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Longitude</th>
            <td class="border p-3">{{ $country->longitude }}</td>
        </tr>

        <tr>
            <th class="border p-3 text-left">Flag</th>
            <td class="border p-3 text-4xl">
                {{ $country->flag }}
            </td>
        </tr>

    </table>

    <div class="mt-6">

        <a href="{{ route('countries.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            ← Kembali

        </a>

    </div>

</div>

@endsection
@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    💰 Detail Economy
</h1>

<div class="bg-white rounded-lg shadow p-6">

<table class="table-auto w-full">

<tr>
    <td class="font-bold w-56 py-3">Country</td>
    <td>{{ $economy->country->name }}</td>
</tr>

<tr>
    <td class="font-bold py-3">GDP</td>
    <td>${{ number_format($economy->gdp,2) }}</td>
</tr>

<tr>
    <td class="font-bold py-3">Inflation</td>
    <td>{{ $economy->inflation }} %</td>
</tr>

<tr>
    <td class="font-bold py-3">Unemployment</td>
    <td>{{ $economy->unemployment }} %</td>
</tr>

<tr>
    <td class="font-bold py-3">Export Value</td>
    <td>${{ number_format($economy->export_value,2) }}</td>
</tr>

<tr>
    <td class="font-bold py-3">Import Value</td>
    <td>${{ number_format($economy->import_value,2) }}</td>
</tr>

<tr>
    <td class="font-bold py-3">Growth</td>
    <td>{{ $economy->growth }} %</td>
</tr>

<tr>
    <td class="font-bold py-3">Year</td>
    <td>{{ $economy->year }}</td>
</tr>

</table>

<div class="mt-6">

<a href="{{ route('economy.index') }}"
   class="bg-gray-600 text-white px-5 py-2 rounded">

Kembali

</a>

</div>

</div>

@endsection
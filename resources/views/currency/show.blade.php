@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
💱 Detail Currency
</h1>

<div class="bg-white rounded-lg shadow p-6">

<table class="w-full">

<tr>

<td class="font-bold w-56 py-2">

Country

</td>

<td>

{{ $currency->country->name }}

</td>

</tr>

<tr>

<td class="font-bold py-2">

Currency Code

</td>

<td>

{{ $currency->code }}

</td>

</tr>

<tr>

<td class="font-bold py-2">

Currency Name

</td>

<td>

{{ $currency->name }}

</td>

</tr>

<tr>

<td class="font-bold py-2">

Symbol

</td>

<td>

{{ $currency->symbol }}

</td>

</tr>

</table>

<div class="mt-6">

<a href="{{ route('currency.index') }}"
class="bg-gray-600 text-white px-5 py-2 rounded">

Kembali

</a>

</div>

</div>

@endsection
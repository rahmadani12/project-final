@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
⭐ Watchlist
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow p-6">

<table class="w-full border-collapse">

<thead>

<tr class="bg-gray-100">

<th class="border p-3">Country</th>

<th class="border p-3">Capital</th>

<th class="border p-3">Region</th>

<th class="border p-3">Risk Level</th>

<th class="border p-3">Action</th>

</tr>

</thead>

<tbody>

@forelse($watchlists as $watch)

<tr>

<td class="border p-2">

{{ $watch->country->name }}

</td>

<td class="border p-2">

{{ $watch->country->capital }}

</td>

<td class="border p-2">

{{ $watch->country->region }}

</td>

<td class="border p-2">

@php

$risk = $watch->country->riskScores->first();

@endphp

@if($risk)

@if($risk->risk_level=="High")

<span class="bg-red-600 text-white px-3 py-1 rounded">

🔴 High

</span>

@elseif($risk->risk_level=="Medium")

<span class="bg-yellow-500 text-white px-3 py-1 rounded">

🟡 Medium

</span>

@else

<span class="bg-green-600 text-white px-3 py-1 rounded">

🟢 Low

</span>

@endif

@else

-

@endif

</td>

<td class="border p-2">

<form action="{{ route('watchlist.destroy',$watch) }}"
      method="POST">

@csrf

@method('DELETE')

<button
class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="5"
class="text-center p-6">

Belum ada negara di Watchlist.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection
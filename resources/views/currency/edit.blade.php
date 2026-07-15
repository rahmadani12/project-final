@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
✏️ Edit Currency
</h1>

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('currency.update',$currency) }}" method="POST">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

<div>

<label>Country</label>

<select name="country_id"
class="w-full border rounded p-2">

@foreach($countries as $country)

<option value="{{ $country->id }}"
{{ $currency->country_id==$country->id?'selected':'' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

<div>

<label>Currency Code</label>

<input
type="text"
name="code"
value="{{ $currency->code }}"
class="w-full border rounded p-2">

</div>

<div>

<label>Currency Name</label>

<input
type="text"
name="name"
value="{{ $currency->name }}"
class="w-full border rounded p-2">

</div>

<div>

<label>Symbol</label>

<input
type="text"
name="symbol"
value="{{ $currency->symbol }}"
class="w-full border rounded p-2">

</div>

</div>

<div class="mt-6">

<button
class="bg-green-600 text-white px-5 py-2 rounded">

Update

</button>

<a href="{{ route('currency.index') }}"
class="bg-gray-600 text-white px-5 py-2 rounded">

Kembali

</a>

</div>

</form>

</div>

@endsection
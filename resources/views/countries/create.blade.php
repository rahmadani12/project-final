@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
🌍 Tambah Country
</h1>

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('countries.store') }}" method="POST">

@csrf

<div class="grid grid-cols-2 gap-5">

<div>
<label>Country</label>
<input type="text"
name="name"
class="w-full border rounded p-2"
required>
</div>

<div>
<label>Code</label>
<input type="text"
name="code"
class="w-full border rounded p-2"
required>
</div>

<div>
<label>Capital</label>
<input type="text"
name="capital"
class="w-full border rounded p-2">
</div>

<div>
<label>Currency</label>
<input type="text"
name="currency"
class="w-full border rounded p-2">
</div>

<div>
<label>Region</label>
<input type="text"
name="region"
class="w-full border rounded p-2">
</div>

<div>
<label>Sub Region</label>
<input type="text"
name="subregion"
class="w-full border rounded p-2">
</div>

<div>
<label>Population</label>
<input type="number"
name="population"
class="w-full border rounded p-2">
</div>

<div>
<label>Flag (Emoji)</label>
<input type="text"
name="flag"
class="w-full border rounded p-2">
</div>

<div>
<label>Latitude</label>
<input type="number"
step="0.000001"
name="latitude"
class="w-full border rounded p-2">
</div>

<div>
<label>Longitude</label>
<input type="number"
step="0.000001"
name="longitude"
class="w-full border rounded p-2">
</div>

</div>

<div class="mt-6">

<button class="bg-blue-600 text-white px-5 py-2 rounded">

Simpan

</button>

<a href="{{ route('countries.index') }}"
class="bg-gray-500 text-white px-5 py-2 rounded">

Kembali

</a>

</div>

</form>

</div>

@endsection
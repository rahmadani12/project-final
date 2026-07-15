@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ✏️ Edit Data Economy
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

<form action="{{ route('economy.update', $economy) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">

        <div>
            <label class="block mb-2 font-semibold">Country</label>

            <select name="country_id"
                    class="w-full border rounded px-3 py-2">

                @foreach($countries as $country)

                    <option value="{{ $country->id }}"
                        {{ $economy->country_id == $country->id ? 'selected' : '' }}>

                        {{ $country->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold">GDP (USD)</label>

            <input type="number"
                   step="0.01"
                   name="gdp"
                   value="{{ old('gdp', $economy->gdp) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Inflation (%)</label>

            <input type="number"
                   step="0.01"
                   name="inflation"
                   value="{{ old('inflation', $economy->inflation) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Unemployment (%)</label>

            <input type="number"
                   step="0.01"
                   name="unemployment"
                   value="{{ old('unemployment', $economy->unemployment) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Export Value (USD)</label>

            <input type="number"
                   step="0.01"
                   name="export_value"
                   value="{{ old('export_value', $economy->export_value) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Import Value (USD)</label>

            <input type="number"
                   step="0.01"
                   name="import_value"
                   value="{{ old('import_value', $economy->import_value) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Economic Growth (%)</label>

            <input type="number"
                   step="0.01"
                   name="growth"
                   value="{{ old('growth', $economy->growth) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-2 font-semibold">Year</label>

            <input type="number"
                   name="year"
                   value="{{ old('year', $economy->year) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

    </div>

    <div class="mt-8">

        <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            Update
        </button>

        <a href="{{ route('economy.index') }}"
           class="bg-gray-600 text-white px-5 py-2 rounded">
            Kembali
        </a>

    </div>

</form>

</div>

@endsection
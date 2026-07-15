@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    💰 Tambah Data Economy
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

<form action="{{ route('economy.store') }}" method="POST">

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
            <label class="block mb-2 font-semibold">GDP (USD)</label>

            <input type="number"
                   step="0.01"
                   name="gdp"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Inflation (%)</label>

            <input type="number"
                   step="0.01"
                   name="inflation"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Unemployment (%)</label>

            <input type="number"
                   step="0.01"
                   name="unemployment"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Export Value (USD)</label>

            <input type="number"
                   step="0.01"
                   name="export_value"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Import Value (USD)</label>

            <input type="number"
                   step="0.01"
                   name="import_value"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Economic Growth (%)</label>

            <input type="number"
                   step="0.01"
                   name="growth"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Year</label>

            <input type="number"
                   name="year"
                   value="{{ date('Y') }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

    </div>

    <div class="mt-8">

        <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

        <a href="{{ route('economy.index') }}"
           class="bg-gray-600 text-white px-5 py-2 rounded">
            Kembali
        </a>

    </div>

</form>

</div>

@endsection
@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    📰 Tambah Berita
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

<form action="{{ route('news.store') }}" method="POST">

    @csrf

    <div class="grid grid-cols-2 gap-6">

        <div>
            <label class="block mb-2 font-semibold">
                Country
            </label>

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

            <label class="block mb-2 font-semibold">
                Source
            </label>

            <input
                type="text"
                name="source"
                class="w-full border rounded px-3 py-2"
                required>

        </div>

        <div class="col-span-2">

            <label class="block mb-2 font-semibold">
                Title
            </label>

            <input
                type="text"
                name="title"
                class="w-full border rounded px-3 py-2"
                required>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Category
            </label>

            <input
                type="text"
                name="category"
                class="w-full border rounded px-3 py-2"
                placeholder="Supply Chain, Logistics, Economy..."
                required>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Published Date
            </label>

            <input
                type="date"
                name="published_at"
                value="{{ date('Y-m-d') }}"
                class="w-full border rounded px-3 py-2"
                required>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Risk Level
            </label>

            <select
                name="risk_level"
                class="w-full border rounded px-3 py-2"
                required>

                <option value="Low">Low</option>

                <option value="Medium">Medium</option>

                <option value="High">High</option>

            </select>

        </div>

        <div class="col-span-2">

            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea
                name="description"
                rows="6"
                class="w-full border rounded px-3 py-2"
                required></textarea>

        </div>

    </div>

    <div class="mt-8">

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            Simpan

        </button>

        <a href="{{ route('news.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            Kembali

        </a>

    </div>

</form>

</div>

@endsection
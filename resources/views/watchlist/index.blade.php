@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

<div class="flex items-center gap-4 mb-8">

<div class="text-6xl">

⭐

</div>

<div>

<h1 class="text-5xl font-bold">

Watchlist

</h1>

<p class="text-gray-500">

Monitor your selected countries.

</p>

</div>

</div>

<div class="bg-white rounded-2xl shadow">

<div class="flex justify-between items-center p-6 border-b">

    <div>

        <h2 class="text-xl font-bold">

            Watchlist Countries

        </h2>

        <p class="text-gray-500 text-sm">

            Monitor selected countries.

        </p>

    </div>

    <form action="{{ route('watchlist.index') }}" method="GET">

        <div class="flex">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Negara..."
                class="border rounded-l-xl px-4 py-3 w-72">

            <button
                class="bg-slate-800 hover:bg-slate-900 text-white px-6 rounded-r-xl">

                Cari

            </button>

        </div>

    </form>

</div>


@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto">

<table class="min-w-full">

    <thead class="bg-gray-50">

        <tr>

            <th class="px-6 py-4 text-center">No</th>

            <th class="px-6 py-4 text-left">Country</th>

            <th class="px-6 py-4 text-left">Capital</th>

            <th class="px-6 py-4 text-left">Region</th>

            <th class="px-6 py-4 text-center">Weather</th>

            <th class="px-6 py-4 text-center">Risk Level</th>

            <th class="px-6 py-4 text-center">Total Risk</th>

            <th class="px-6 py-4 text-center">Action</th>

        </tr>

    </thead>

    <tbody>

        @forelse($watchlists as $watch)

        @php
            $weather = $watch->country->weatherData->first();
            $risk = $watch->country->riskScores->first();
        @endphp

        <tr class="border-b hover:bg-gray-50">

            <td class="px-6 py-4 text-center">

                {{ $loop->iteration + ($watchlists->currentPage()-1) * $watchlists->perPage() }}

            </td>

            <td class="px-6 py-4">

                {{ $watch->country->name }}

            </td>

            <td class="px-6 py-4">

                {{ $watch->country->capital }}

            </td>

            <td class="px-6 py-4">

                {{ $watch->country->region }}

            </td>

            <td class="px-6 py-4 text-center">

                {{ $weather->condition ?? '-' }}

            </td>

            <td class="px-6 py-4 text-center">

                @if($risk)

                    @if($risk->risk_level=="High")

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            🔴 High

                        </span>

                    @elseif($risk->risk_level=="Medium")

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            🟡 Medium

                        </span>

                    @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            🟢 Low

                        </span>

                    @endif

                @else

                    -

                @endif

            </td>

            <td class="px-6 py-4 text-center font-bold text-blue-600">

                {{ $risk->total_score ?? '-' }}

            </td>

            <td class="text-center">

                <a href="{{ route('watchlist.show',$watch) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">

                    Detail

                </a>

                <form
                    action="{{ route('watchlist.destroy',$watch) }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

                        Hapus

                    </button>

                </form>

            </td>
        </tr>

        @empty

        <tr>

            <td colspan="8" class="text-center py-8">

                Belum ada negara di Watchlist.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

</div>

<div class="flex justify-between items-center p-6 border-t">

    <div class="text-gray-500">

        Menampilkan

        {{ $watchlists->firstItem() ?? 0 }}

        -

        {{ $watchlists->lastItem() ?? 0 }}

        dari

        {{ $watchlists->total() }}

        data

    </div>

    {{ $watchlists->links() }}

</div>

@endsection
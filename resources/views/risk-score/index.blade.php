@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">

        <div class="text-6xl">
            ⚠️
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Risk Score Management
            </h1>

            <p class="text-gray-500 mt-2">
                Calculate country risk based on Weather, Economy and News.
            </p>

        </div>

    </div>

   <div class="flex gap-3 mb-6">

        <form action="{{ route('risk-score.calculateAll') }}" method="POST">

            @csrf

            <button
                onclick="return confirm('Hitung semua negara?')"
                class="inline-flex items-center px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold">

                <i class="fas fa-sync-alt mr-2"></i>

                Hitung Semua

            </button>

        </form>

    </div>

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

        <th class="border p-3">Weather</th>

        <th class="border p-3">Economy</th>

        <th class="border p-3">News</th>

        <th class="border p-3">Total</th>

        <th class="border p-3">Level</th>

        <th class="border p-3">Action</th>

    </tr>

    </thead>

    <tbody>

    @forelse($riskScores as $risk)

        <tr>

            <td class="border p-2">
                {{ $risk->country->name ?? '-' }}
            </td>

            <td class="border p-2 text-center">
                {{ $risk->weather_score ?? '-' }}
            </td>

            <td class="border p-2 text-center">
                {{ $risk->economy_score ?? '-' }}
            </td>

            <td class="border p-2 text-center">
                {{ $risk->news_score ?? '-' }}
            </td>

            <td class="border p-2 text-center font-bold">
                {{ $risk->total_score ?? '-' }}
            </td>

            <td class="border p-2 text-center">

                @if($risk->risk_level == 'High')

                    <span class="bg-red-600 text-white px-3 py-1 rounded">
                        🔴 High
                    </span>

                @elseif($risk->risk_level == 'Medium')

                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">
                        🟡 Medium
                    </span>

                @elseif($risk->risk_level == 'Low')

                    <span class="bg-green-600 text-white px-3 py-1 rounded">
                        🟢 Low
                    </span>

                @else

                    -

                @endif

            </td>

            <td class="px-6 py-5 text-center">

                @if($risk)

                    <a href="{{ route('risk-score.show',$risk) }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg">

                        Detail

                    </a>

                @endif

                <form action="{{ route('risk-score.calculate',$risk) }}"
                    method="POST"
                    class="inline">

                    @csrf

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

                        Hitung

                    </button>

                </form>

                <form action="{{ route('watchlist.store',$risk) }}"
                    method="POST"
                    class="inline">

                    @csrf

                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                        ⭐ Watchlist

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7" class="text-center p-6">

                Belum ada data.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6">

        <div class="text-sm text-gray-600 mb-3 md:mb-0">
            Menampilkan
            <span class="font-semibold">{{ $riskScores->firstItem() }}</span>
            -
            <span class="font-semibold">{{ $riskScores->lastItem() }}</span>
            dari
            <span class="font-semibold">{{ $riskScores->total() }}</span>
            data
        </div>

        <div>
            {{ $riskScores->links() }}
        </div>

    </div>

</div>

@endsection
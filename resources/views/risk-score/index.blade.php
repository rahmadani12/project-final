@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ⚠️ Risk Score Management
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

        <th class="border p-3">Weather</th>

        <th class="border p-3">Economy</th>

        <th class="border p-3">News</th>

        <th class="border p-3">Total</th>

        <th class="border p-3">Level</th>

        <th class="border p-3">Action</th>

    </tr>

    </thead>

    <tbody>

    @forelse($countries as $country)

        @php
            $risk = $country->riskScores->first();
        @endphp

        <tr>

            <td class="border p-2">
                {{ $country->name }}
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

                @if($risk)

                    @if($risk->risk_level=='High')

                        <span class="bg-red-600 text-white px-3 py-1 rounded">

                            🔴 High

                        </span>

                    @elseif($risk->risk_level=='Medium')

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

            <td class="border p-2 text-center">

                @if($risk)

                    <a href="{{ route('risk-score.show',$risk) }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                        Detail

                    </a>

                @endif

                <form
                    action="{{ route('risk-score.calculate',$country) }}"
                    method="POST"
                    class="inline">

                    @csrf

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">

                        Hitung

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7"
                class="text-center p-6">

                Belum ada data.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>

@endsection
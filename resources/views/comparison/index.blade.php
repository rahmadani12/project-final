@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-6xl">
            📊
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Country Comparison
            </h1>

            <p class="text-gray-500 mt-2">
                Compare risk indicators between countries.
            </p>

        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <form method="GET"
              action="{{ route('comparison.index') }}">

            <div class="grid grid-cols-4 gap-4">

                <select
                    name="countries[]"
                    class="border rounded-xl p-3">

                    <option value="">Select Country</option>

                    @foreach($countries as $country)

                        <option
                            value="{{ $country->id }}"
                            {{ in_array($country->id,$selected) ? 'selected':'' }}>

                            {{ $country->name }}

                        </option>

                    @endforeach

                </select>

                <select
                    name="countries[]"
                    class="border rounded-xl p-3">

                    <option value="">Select Country</option>

                    @foreach($countries as $country)

                        <option
                            value="{{ $country->id }}"
                            {{ in_array($country->id,$selected) ? 'selected':'' }}>

                            {{ $country->name }}

                        </option>

                    @endforeach

                </select>

                <select
                    name="countries[]"
                    class="border rounded-xl p-3">

                    <option value="">Select Country</option>

                    @foreach($countries as $country)

                        <option
                            value="{{ $country->id }}"
                            {{ in_array($country->id,$selected) ? 'selected':'' }}>

                            {{ $country->name }}

                        </option>

                    @endforeach

                </select>

                <button
                    class="bg-pink-600 hover:bg-pink-700 text-white rounded-xl">

                    Compare

                </button>

            </div>

        </form>

    </div>

</div>

@if(isset($comparison) && $comparison->count() > 0)

<div class="bg-white rounded-2xl shadow mt-8 overflow-hidden">

    <div class="p-6 border-b">

        <h2 class="text-2xl font-bold text-slate-800">
            Comparison Result
        </h2>

    </div>

    <table class="min-w-full">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-6 py-4 text-left">
                    Country
                </th>

                <th class="px-6 py-4 text-center">
                    Weather
                </th>

                <th class="px-6 py-4 text-center">
                    Economy
                </th>

                <th class="px-6 py-4 text-center">
                    News
                </th>

                <th class="px-6 py-4 text-center">
                    Total
                </th>

                <th class="px-6 py-4 text-center">
                    Risk Level
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($comparison as $risk)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-6 py-5 font-semibold">

                    {{ $risk->country->name }}

                </td>

                <td class="px-6 py-5 text-center">

                    {{ $risk->weather_score }}

                </td>

                <td class="px-6 py-5 text-center">

                    {{ $risk->economy_score }}

                </td>

                <td class="px-6 py-5 text-center">

                    {{ $risk->news_score }}

                </td>

                <td class="px-6 py-5 text-center font-bold text-blue-600">

                    {{ $risk->total_score }}

                </td>

                <td class="px-6 py-5 text-center">

                    @if($risk->risk_level == 'High')

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            🔴 High

                        </span>

                    @elseif($risk->risk_level == 'Medium')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            🟡 Medium

                        </span>

                    @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            🟢 Low

                        </span>

                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    @if(isset($comparison) && $comparison->count() > 0)

    <div class="bg-white rounded-2xl shadow mt-8 p-6">

        <h2 class="text-2xl font-bold mb-5">

            Risk Score Chart

        </h2>

        <canvas id="riskChart" height="120"></canvas>

    </div>

    @endif

</div>

@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(isset($comparison) && $comparison->count() > 0)

<script>

const ctx = document.getElementById('riskChart');

new Chart(ctx,{

    type:'bar',

    data:{

        labels:[
            @foreach($comparison as $risk)
                "{{ $risk->country->name }}",
            @endforeach
        ],

        datasets:[{

            label:'Total Risk Score',

            data:[
                @foreach($comparison as $risk)
                    {{ $risk->total_score }},
                @endforeach
            ]

        }]

    },

    options:{
        responsive:true
    }

});

</script>

@endif

@endsection
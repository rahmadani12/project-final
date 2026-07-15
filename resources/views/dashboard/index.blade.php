@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
🌍 Global Supply Chain Risk Intelligence Platform
</h1>

<div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-blue-600 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Countries</h2>
        <p class="text-4xl font-bold mt-2">{{ $countries }}</p>
    </div>

    <div class="bg-green-600 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Ports</h2>
        <p class="text-4xl font-bold mt-2">{{ $ports }}</p>
    </div>

    <div class="bg-yellow-500 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Weather</h2>
        <p class="text-4xl font-bold mt-2">{{ $weather }}</p>
    </div>

    <div class="bg-purple-600 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Economy</h2>
        <p class="text-4xl font-bold mt-2">{{ $economies }}</p>
    </div>

    <div class="bg-indigo-600 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">News</h2>
        <p class="text-4xl font-bold mt-2">{{ $news }}</p>
    </div>

    <div class="bg-red-600 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">High Risk</h2>
        <p class="text-4xl font-bold mt-2">{{ $high }}</p>
    </div>

    <div class="bg-orange-500 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Medium Risk</h2>
        <p class="text-4xl font-bold mt-2">{{ $medium }}</p>
    </div>

    <div class="bg-green-700 text-white rounded-lg shadow p-5">
        <h2 class="text-lg">Low Risk</h2>
        <p class="text-4xl font-bold mt-2">{{ $low }}</p>
    </div>

</div>

<div class="grid grid-cols-2 gap-6">

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-bold mb-4">
            📊 Risk Distribution
        </h2>

        <canvas id="riskChart"></canvas>

    </div>

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-bold mb-4">
            🏆 Top 10 High Risk Countries
        </h2>

        <table class="w-full">

            <thead>

            <tr>

                <th class="text-left border-b p-2">Country</th>
                <th class="text-center border-b p-2">Score</th>
                <th class="text-center border-b p-2">Level</th>

            </tr>

            </thead>

            <tbody>

            @forelse($topRisk as $risk)

                <tr>

                    <td class="border-b p-2">
                        {{ $risk->country->name }}
                    </td>

                    <td class="text-center border-b">
                        {{ $risk->total_score }}
                    </td>

                    <td class="text-center border-b">

                        @if($risk->risk_level=='High')

                            <span class="bg-red-600 text-white px-2 py-1 rounded">

                                High

                            </span>

                        @elseif($risk->risk_level=='Medium')

                            <span class="bg-yellow-500 text-white px-2 py-1 rounded">

                                Medium

                            </span>

                        @else

                            <span class="bg-green-600 text-white px-2 py-1 rounded">

                                Low

                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="text-center py-5">

                        Belum ada data Risk Score.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>

const ctx=document.getElementById('riskChart');

new Chart(ctx,{

type:'pie',

data:{

labels:['High','Medium','Low'],

datasets:[{

data:[

{{ $high }},

{{ $medium }},

{{ $low }}

]

}]

}

});

</script>

@endsection
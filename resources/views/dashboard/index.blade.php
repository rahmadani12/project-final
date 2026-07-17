@extends('layouts.app')

@section('content')

<div class="mb-8">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#800021]">

                Dashboard

            </h1>

            <p class="text-gray-500 mt-2">

                Global Supply Chain Risk Intelligence Platform

            </p>

        </div>

        <button
            class="bg-[#C24366] hover:bg-[#881144] text-white px-6 py-3 rounded-xl shadow-lg">

            🔄 Sync All API

        </button>

    </div>

</div>


<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Countries

                </p>

                <h2 class="text-5xl font-bold text-[#800021] mt-4">

                    {{ $countryCount }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">

                🌍

            </div>

        </div>

    </div>


    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Weather

                </p>

                <h2 class="text-5xl font-bold text-blue-500 mt-4">

                    {{ $weatherCount }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                🌦

            </div>

        </div>

    </div>


    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Economy

                </p>

                <h2 class="text-5xl font-bold text-green-500 mt-4">

                    {{ $economyCount }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                💰

            </div>

        </div>

    </div>


    <div class="bg-white rounded-3xl shadow-lg p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    News

                </p>

                <h2 class="text-5xl font-bold text-red-500 mt-4">

                    {{ $newsCount }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl">

                📰

            </div>

        </div>

    </div>

</div>


    <!-- Second Row -->

   <div class="grid grid-cols-12 gap-6 mt-8">

        {{-- Risk Distribution Chart --}}
        <div class="col-span-12 lg:col-span-4">

            <div class="bg-white rounded-3xl shadow-lg p-6 h-[430px]">

            <h2 class="text-2xl font-bold text-[#800021] mb-4">

            Risk Distribution

            </h2>

        <div class="flex justify-center items-center h-[320px]">

        <canvas id="riskChart"></canvas>

            </div>

        </div>

        </div>

        <div class="col-span-12 lg:col-span-8">

            <div class="bg-white rounded-3xl shadow-lg p-6 h-[430px]">

            <h2 class="text-2xl font-bold text-[#800021] mb-4">

            🌍 Global Supply Chain Map

            </h2>

            <div id="worldMap"
                class="rounded-2xl h-[330px]"></div>

            </div>

        </div>
    


    {{-- Risk Summary --}}
    <div class="col-span-12 lg:col-span-4">

    <div class="bg-white rounded-3xl shadow-lg p-6">

    <h2 class="text-2xl font-bold text-[#800021] mb-6">

    Risk Summary

    </h2>

    <div class="space-y-5">

    <div class="flex justify-between items-center">

    <span>

    🔴 High Risk

    </span>

    <span
    class="bg-red-100 text-red-600 rounded-full px-4 py-2 font-bold">

    {{ $highRisk }}

    </span>

    </div>

    <div class="flex justify-between items-center">

    <span>

    🟡 Medium Risk

    </span>

    <span
    class="bg-yellow-100 text-yellow-600 rounded-full px-4 py-2 font-bold">

    {{ $mediumRisk }}

    </span>

    </div>

    <div class="flex justify-between items-center">

    <span>

    🟢 Low Risk

    </span>

    <span
    class="bg-green-100 text-green-600 rounded-full px-4 py-2 font-bold">

    {{ $lowRisk }}

    </span>

    </div>

    </div>

    </div>

    </div>



    {{-- Top Risk Countries --}}
    <div class="col-span-12 lg:col-span-8">
    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-[#800021] mb-6">

            Top Risk Countries

        </h2>

        @forelse($topRisk as $risk)

            <div class="flex justify-between items-center py-3 border-b">

                <div>

                    <p class="font-semibold">

                        {{ $risk->country->flag }}

                        {{ $risk->country->name }}

                    </p>

                    <p class="text-sm text-gray-500">

                        {{ $risk->risk_level }}

                    </p>

                </div>

                <span
                    class="bg-[#C24366] text-white px-3 py-1 rounded-full">

                    {{ $risk->total_score }}

                </span>

            </div>

        @empty

            <p class="text-gray-500">

                No Data

            </p>

        @endforelse

    </div>
    </div>
    </div>


    {{-- Latest News --}}
    <div class="grid grid-cols-12 gap-6 mt-6">

        <div class="col-span-12">

            <div class="bg-white rounded-3xl shadow-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h2 class="text-2xl font-bold text-[#800021]">

                        Latest News

                    </h2>

                    <a href="#" class="text-[#C24366] font-semibold">

                        View All

                    </a>

                </div>

                <div class="space-y-4">

                    @foreach($latestNews as $news)

                        <div class="border rounded-xl p-5 hover:bg-pink-50 transition">

                            <h3 class="font-semibold text-lg">

                                {{ $news->title }}

                            </h3>

                            <p class="text-gray-500 mt-2">

                                {{ $news->country->name }}

                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-xl font-bold text-[#800021]">

            🚢 Ports

        </h2>

        <h1 class="text-5xl font-bold mt-5">

            {{ $portCount }}

        </h1>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-xl font-bold text-[#800021]">

            🌍 Recent Countries

        </h2>

        @foreach($recentCountries as $country)

            <div class="flex justify-between py-2">

                <span>

                    {{ $country->flag }}

                    {{ $country->name }}

                </span>

                <span>

                    {{ $country->code }}

                </span>

            </div>

        @endforeach

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-xl font-bold text-[#800021]">

            System Status

        </h2>

        <div class="mt-6 space-y-4">

            <div class="flex justify-between">

                <span>Weather API</span>

                <span class="text-green-600 font-bold">

                    Online

                </span>

            </div>

            <div class="flex justify-between">

                <span>Currency API</span>

                <span class="text-green-600 font-bold">

                    Online

                </span>

            </div>

            <div class="flex justify-between">

                <span>News API</span>

                <span class="text-green-600 font-bold">

                    Online

                </span>

            </div>

            <div class="flex justify-between">

                <span>World Bank API</span>

                <span class="text-green-600 font-bold">

                    Online

                </span>

            </div>

        </div>

    </div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

    const ctx=document.getElementById('riskChart');

    new Chart(ctx,{

    type:'doughnut',

    data:{

    labels:['High','Medium','Low'],

    datasets:[{

    data:@json($chart),

    backgroundColor:[

    '#dc2626',

    '#facc15',

    '#16a34a'

    ],

    borderWidth:0

    }]

    },

    options:{

    plugins:{

    legend:{

    position:'bottom'

    }

    }

    }

    });

    </script>

    @push('scripts')

    <script>

    const map=L.map('worldMap').setView([20,0],2);

    L.tileLayer(

    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',

    {

    maxZoom:18,

    attribution:'OpenStreetMap'

    }

    ).addTo(map);

    const countries=@json($mapCountries);

    countries.forEach(country=>{

    L.marker([

    country.latitude,

    country.longitude

    ])

    .addTo(map)

    .bindPopup(

    `<b>${country.flag} ${country.name}</b>`

    );

    });

    </script>

    @endpush

@endsection
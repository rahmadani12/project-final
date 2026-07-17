@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold text-[#800021]">

                    🌍 Countries Monitoring

                </h1>

                <p class="text-gray-500 mt-2">

                    Monitor countries, economy, weather, currency and global risks.

                </p>

            </div>

            <form action="{{ route('countries.import') }}" method="POST">

                @csrf

                <button
                    class="bg-[#C24366] hover:bg-[#881144] text-white px-8 py-4 rounded-2xl shadow">

                    🔄 Sync Countries API

                </button>

            </form>

        </div>

    </div>



    {{-- Statistik --}}

    <div class="grid grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl p-6 shadow">

            <h2 class="text-gray-500">

                Total Countries

            </h2>

            <p class="text-5xl font-bold text-[#800021] mt-3">

                {{ $countries->total() }}

            </p>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow">

            <h2 class="text-gray-500">

                Region

            </h2>

            <p class="text-5xl font-bold text-[#C24366] mt-3">

                {{ $countries->pluck('region')->unique()->count() }}

            </p>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow">

            <h2 class="text-gray-500">

                Currency

            </h2>

            <p class="text-5xl font-bold text-pink-500 mt-3">

                {{ $countries->pluck('currency')->unique()->count() }}

            </p>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow">

            <h2 class="text-gray-500">

                Population

            </h2>

            <p class="text-xl font-bold text-green-600 mt-4">

                {{ number_format($countries->sum('population')) }}

            </p>

        </div>

    </div>



    {{-- Search --}}

    <div class="bg-white rounded-3xl shadow p-6">

        <form
            action="{{ route('countries.index') }}"
            method="GET"
            class="grid grid-cols-12 gap-4">

            <div class="col-span-9">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search country..."
                    class="w-full border rounded-2xl px-5 py-4">

            </div>

            <div class="col-span-3">

                <button
                    class="w-full bg-[#800021] hover:bg-[#881144] text-white py-4 rounded-2xl">

                    Search

                </button>

            </div>

        </form>

    </div>



    {{-- Cards --}}

    <div class="grid grid-cols-4 gap-6">

        @foreach($countries as $country)

            <div
                class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">

                <div class="p-6">

                    <div class="flex items-center gap-4">

                        <div>

                            <img
                                src="https://flagcdn.com/w80/{{ strtolower($country->code) }}.png"
                                alt="{{ $country->name }}"
                                class="w-14 h-10 rounded-lg object-cover shadow border">

                        </div>

                        <div>

                            <h2 class="font-bold text-xl">

                                {{ $country->name }}

                            </h2>

                            <p class="text-gray-500">

                                {{ $country->code }}

                                @if($country->iso3)

                                    • {{ $country->iso3 }}

                                @endif

                            </p>

                        </div>

                    </div>

                    <div class="mt-6 space-y-2">

                        <p>

                            🌍 {{ $country->region }}

                        </p>

                        <p>

                            💰 {{ $country->currency }}

                        </p>

                        <p>

                            👥 {{ number_format($country->population) }}

                        </p>

                    </div>

                    <div class="mt-6">

                        @php

                            $risk = ['SAFE','MEDIUM','HIGH'][rand(0,2)];

                        @endphp

                        @if($risk=='SAFE')

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                                SAFE

                            </span>

                        @elseif($risk=='MEDIUM')

                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                                MEDIUM

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                                HIGH

                            </span>

                        @endif

                    </div>

                    <div class="mt-8">

                        <a
                            href="{{ route('countries.show',$country) }}"
                            class="block text-center bg-[#C24366] hover:bg-[#881144] text-white py-3 rounded-xl">

                            View Detail

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>



    <div class="mt-10">

        {{ $countries->links() }}

    </div>

</div>

@endsection
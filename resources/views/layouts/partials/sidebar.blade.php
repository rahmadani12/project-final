<div class="w-64 bg-slate-900 text-white min-h-screen shadow-lg">

    <div class="p-6 border-b border-slate-700">
        <h1 class="text-xl font-bold">
            🌍 Global Supply Chain
        </h1>

        <p class="text-sm text-gray-300 mt-1">
            Risk Intelligence Platform
        </p>
    </div>

    <nav class="mt-4">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('dashboard') ? 'bg-slate-700' : '' }}">
            📊 Dashboard
        </a>

        <a href="{{ route('countries.index') }}"
           class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('countries.*') ? 'bg-slate-700' : '' }}">
            🌎 Countries
        </a>

        <a href="{{ route('weather.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            🌦
            <span class="ml-3">Weather</span>
        </a>
     
        <a href="{{ route('economy.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            💰  
            <span class="ml-3">Economy</span>
        </a>

        <a href="{{ route('currency.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            💱
            <span class="ml-3">Currency</span>
        </a>

        <a href="{{ route('ports.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            🚢
            <span class="ml-3">Ports</span>
        </a>

        <a href="{{ route('news.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            📰
            <span class="ml-3">News</span>
        </a>

         <a href="{{ route('risk-score.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            ⚠️
            <span class="ml-3">Risk Score</span>
        </a>

         <a href="{{ route('comparison.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            📊
            <span class="ml-3">Comparison</span>
        </a>

        <a href="{{ route('watchlist.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            ⭐
            <span class="ml-3">Watchlist</span>
        </a>

        <a href="{{ route('map.index') }}"
        class="flex items-center px-6 py-3 hover:bg-gray-700">
            🗺
            <span class="ml-3">Interactive Map</span>
        </a>


    </nav>

</div>
<aside class="w-72 bg-[#800021] text-white min-h-screen flex flex-col">
    <!-- Logo -->
    <div class="p-8 border-b border-[#C24366]">
        <div class="bg-[#C24366] rounded-xl p-4">
        <div class="flex items-center gap-3">

            <div class="text-3xl">
                🌍
            </div>

            <div>

                <h1 class="text-xl font-bold leading-tight">
                    Global Supply Chain
                </h1>

                <p class="text-sm text-pink-200 mt-1">
                    Risk Intelligence Platform
                </p>

            </div>

        </div>
        </div>

    </div>

    <!-- Menu -->
    <nav class="flex-1 px-5 py-6 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span>📊</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('countries.index') }}"
           class="sidebar-item {{ request()->routeIs('countries.*') ? 'active' : '' }}">
            <span>🌍</span>
            <span>Countries</span>
        </a>

        <a href="{{ route('weather.index') }}"
           class="sidebar-item {{ request()->routeIs('weather.*') ? 'active' : '' }}">
            <span>🌦</span>
            <span>Weather</span>
        </a>

        <a href="{{ route('economy.index') }}"
           class="sidebar-item {{ request()->routeIs('economy.*') ? 'active' : '' }}">
            <span>💰</span>
            <span>Economy</span>
        </a>

        <a href="{{ route('currency.index') }}"
           class="sidebar-item {{ request()->routeIs('currency.*') ? 'active' : '' }}">
            <span>💱</span>
            <span>Currency</span>
        </a>

        <a href="{{ route('ports.index') }}"
           class="sidebar-item {{ request()->routeIs('ports.*') ? 'active' : '' }}">
            <span>🚢</span>
            <span>Ports</span>
        </a>

        <a href="{{ route('news.index') }}"
           class="sidebar-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
            <span>📰</span>
            <span>News</span>
        </a>

        <a href="{{ route('risk-scores.index') }}"
           class="sidebar-item {{ request()->routeIs('risk-scores.*') ? 'active' : '' }}">
            <span>⚠️</span>
            <span>Risk Score</span>
        </a>

        <a href="{{ route('comparison.index') }}"
           class="sidebar-item {{ request()->routeIs('comparison.*') ? 'active' : '' }}">
            <span>📊</span>
            <span>Comparison</span>
        </a>

        <a href="{{ route('watchlist.index') }}"
           class="sidebar-item {{ request()->routeIs('watchlist.*') ? 'active' : '' }}">
            <span>⭐</span>
            <span>Watchlist</span>
        </a>

        <a href="{{ route('map.index') }}"
           class="sidebar-item {{ request()->routeIs('map.*') ? 'active' : '' }}">
            <span>🗺️</span>
            <span>Interactive Map</span>
        </a>

    </nav>

</aside>
<header class="bg-white shadow-sm border-b border-pink-100">

    <div class="flex justify-between items-center px-8 py-5">

        {{-- Search Menu --}}
        <div class="relative w-96">

            <input
                id="menuSearch"
                type="text"
                placeholder="🔍 Search menu..."
                class="w-full pl-5 pr-5 py-3 rounded-xl border border-gray-300 focus:border-[#C24366] focus:ring-2 focus:ring-pink-200 outline-none">

            <div
                id="menuResult"
                class="hidden absolute top-14 left-0 w-full bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden z-50">

            </div>

        </div>

        {{-- Right Menu --}}
        <div class="flex items-center gap-6">

            {{-- Sync --}}
            <button
                class="bg-[#C24366] hover:bg-[#881144] text-white px-6 py-3 rounded-xl font-semibold transition">

                🔄 Sync Data

            </button>

            {{-- Notification --}}
            <div class="relative cursor-pointer">

                <span class="text-3xl">
                    🔔
                </span>

                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">

                    3

                </span>

            </div>

            {{-- User --}}
            <div class="flex items-center gap-3">

                <div
                    class="w-12 h-12 rounded-full bg-[#C24366] text-white flex items-center justify-center font-bold text-lg">

                    A

                </div>

                <div>

                    <p class="font-semibold">
                        Administrator
                    </p>

                    <p class="text-sm text-gray-500">
                        Online
                    </p>

                </div>

            </div>

        </div>

    </div>

</header>

<script>
    const menus = [

        {
            icon: "📊",
            name: "Dashboard",
            url: "{{ route('dashboard') }}"
        },

        {
            icon: "🌍",
            name: "Countries",
            url: "{{ route('countries.index') }}"
        },

        {
            icon: "🌦️",
            name: "Weather",
            url: "{{ route('weather.index') }}"
        },

        {
            icon: "💰",
            name: "Economy",
            url: "{{ route('economy.index') }}"
        },

        {
            icon: "🚢",
            name: "Ports",
            url: "{{ route('ports.index') }}"
        },

        {
            icon: "📰",
            name: "News",
            url: "{{ route('news.index') }}"
        },

        {
            icon: "⚠️",
            name: "Risk Score",
            url: "{{ route('risk-scores.index') }}"
        },

        {
            icon: "💱",
            name: "Currency",
            url: "{{ route('currency.index') }}"
        },

        {
            icon: "📈",
            name: "Comparison",
            url: "{{ route('comparison.index') }}"
        },

        {
            icon: "⭐",
            name: "Watchlist",
            url: "{{ route('watchlist.index') }}"
        },

        {
            icon: "🗺️",
            name: "Interactive Map",
            url: "{{ route('map.index') }}"
        }

    ];

    const input = document.getElementById('menuSearch');
    const result = document.getElementById('menuResult');

    input.addEventListener('keyup', function () {

        const keyword = this.value.toLowerCase();

        result.innerHTML = '';

        if (keyword === '') {
            result.classList.add('hidden');
            return;
        }

        const filtered = menus.filter(menu =>
            menu.name.toLowerCase().includes(keyword)
        );

        if (filtered.length === 0) {

            result.innerHTML =
                '<div class="p-4 text-gray-500">Menu tidak ditemukan</div>';

        } else {

            filtered.forEach(menu => {

                result.innerHTML += `
                    <a href="${menu.url}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-pink-50 transition">

                        <span class="text-xl">${menu.icon}</span>

                        <span>${menu.name}</span>

                    </a>
                `;

            });

        }

        result.classList.remove('hidden');

    });

    document.addEventListener('click', function(e){

        if(
            !input.contains(e.target) &&
            !result.contains(e.target)
        ){
            result.classList.add('hidden');
        }

    });
</script>
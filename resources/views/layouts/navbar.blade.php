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

            {{-- Notification --}}
            <div class="relative">

                <button
                    id="notificationBtn"
                    class="relative text-3xl hover:scale-110 transition">

                    🔔

                    @if($notifications->count())

                        <span
                            class="absolute -top-2 -right-2
                            bg-red-500 text-white
                            text-xs font-bold
                            rounded-full
                            w-5 h-5
                            flex items-center justify-center">

                            {{ $notifications->count() }}

                        </span>

                    @endif

                </button>

                <div
                    id="notificationMenu"
                    class="hidden absolute right-0 mt-3
                        w-96 bg-white rounded-2xl
                        shadow-2xl border border-pink-100
                        overflow-hidden z-50">

                    <div class="px-5 py-4 border-b">

                        <h3 class="font-bold text-lg">
                            🔔 Notifications
                        </h3>

                    </div>

                    @forelse($notifications as $item)

                        <div
                            class="px-5 py-4 hover:bg-pink-50
                            border-b cursor-pointer">

                            <div class="font-semibold">

                                {{ $item->icon }}

                                {{ $item->title }}

                            </div>

                            <div
                                class="text-sm text-gray-500 mt-1">

                                {{ $item->message }}

                            </div>

                            <div
                                class="text-xs text-pink-600 mt-2">

                                {{ $item->created_at->diffForHumans() }}

                            </div>

                        </div>

                    @empty

                        <div class="p-6 text-center text-gray-500">

                            Tidak ada notifikasi

                        </div>

                    @endforelse

                </div>

            </div>

            {{-- User --}}
            <div class="relative">

                <button
                    id="userMenuBtn"
                    class="flex items-center gap-3 hover:bg-gray-100 rounded-xl px-3 py-2 transition">

                    <div
                        class="w-12 h-12 rounded-full bg-[#C24366] text-white flex items-center justify-center font-bold text-lg">

                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                    </div>

                    <div class="text-left">

                        <p class="font-semibold">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Online
                        </p>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"/>

                    </svg>

                </button>

                {{-- Dropdown --}}
                <div id="userMenu"
                    class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border overflow-hidden z-50">

                    <a href="{{ route('profile') }}"
                    class="block px-5 py-3 hover:bg-pink-50">

                        👤 My Profile

                    </a>

                    <a href="#"
                    class="block px-5 py-3 hover:bg-pink-50">

                        ⚙️ Account Settings

                    </a>

                    <a href="#"
                    class="block px-5 py-3 hover:bg-pink-50">

                        🔒 Change Password

                    </a>

                    <hr>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="w-full text-left px-5 py-3 text-red-600 hover:bg-red-50">

                            🚪 Logout

                        </button>

                    </form>

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

    // Notification

    const notificationBtn =
    document.getElementById("notificationBtn");

    const notificationMenu =
    document.getElementById("notificationMenu");

    notificationBtn.addEventListener("click", function(e){

        e.stopPropagation();

        notificationMenu.classList.toggle("hidden");

    });

    document.addEventListener("click", function(e){

        if(
            !notificationMenu.contains(e.target) &&
            !notificationBtn.contains(e.target)
        ){

            notificationMenu.classList.add("hidden");

        }

    });

    // User Menu

    const userBtn = document.getElementById("userMenuBtn");
    const userMenu = document.getElementById("userMenu");

    if (userBtn && userMenu) {

        userBtn.addEventListener("click", function(e){

            e.stopPropagation();

            userMenu.classList.toggle("hidden");

        });

        document.addEventListener("click", function(e){

            if(
                !userBtn.contains(e.target) &&
                !userMenu.contains(e.target)
            ){

                userMenu.classList.add("hidden");

            }

        });

    }
</script>
<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <h2 class="text-2xl font-bold text-slate-700">

        Global Supply Chain Dashboard

    </h2>

    <div class="flex items-center gap-4">

        <span class="text-gray-700">

            👤 {{ Auth::user()->name }}

        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                Logout

            </button>

        </form>

    </div>

</nav>
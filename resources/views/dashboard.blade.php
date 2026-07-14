<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🌍 Global Supply Chain Risk Intelligence Platform
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-blue-600 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">Countries</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>

                <div class="bg-red-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">High Risk</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>

                <div class="bg-green-600 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">Ports</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">News Today</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>

            </div>

            <!-- Grafik -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">
                        📈 GDP Trend
                    </h3>

                    <div class="h-64 flex items-center justify-center text-gray-400">
                        Chart akan ditampilkan di sini
                    </div>

                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">
                        🌦 Weather Monitoring
                    </h3>

                    <div class="h-64 flex items-center justify-center text-gray-400">
                        Data cuaca akan ditampilkan di sini
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
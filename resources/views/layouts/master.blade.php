<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Leaflet CSS -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    @include('layouts.partials.sidebar')

    <div class="flex-1">

        @include('layouts.partials.navbar')

        <main class="p-6">
            @yield('content')
        </main>

        @include('layouts.partials.footer')

    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</body>
</html>
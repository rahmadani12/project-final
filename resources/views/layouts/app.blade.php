<!DOCTYPE html>
<html lang="en">

<head>

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Global Supply Chain</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-[#FFE6F0]">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Content --}}
        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @stack('scripts')

</body>

</html>
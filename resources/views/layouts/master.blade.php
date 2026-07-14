<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
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

</body>
</html>
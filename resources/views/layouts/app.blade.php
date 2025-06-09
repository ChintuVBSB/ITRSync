<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITRSync App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- If using Laravel Vite -->
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Flash messages -->
    @if(session('success'))
        <div class="max-w-4xl mx-auto mt-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Content -->
    <div class="max-w-5xl mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>

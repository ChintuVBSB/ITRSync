<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'ITR Sync' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    {{ $slot }}
      @if(session('success'))
        <div class="max-w-4xl mx-auto p-4 bg-green-100 text-green-800 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif
    @livewireScripts
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>

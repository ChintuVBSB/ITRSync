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
    @livewireScripts
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>

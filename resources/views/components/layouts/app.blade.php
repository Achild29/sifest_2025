<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="icon" type="image/x-icon" href="https://my.unpam.ac.id/icons/logo.png">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        <title>{{ $title ?? 'Aplikasi Absensi' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])        
        @fluxAppearance
        @stack('html5-qrcode')
        </head>
        <body class="min-h-screen bg-white dark:bg-zinc-700">
            <x-sidebar></x-sidebar>
            <x-header>
                {{ $slot }}
            </x-header>
        
            <flux:main>
                {{ $slot }}
                <x-toaster-hub />
            </flux:main>
            
            @fluxScripts
            @stack('scan-qr')
        </body>
</html>
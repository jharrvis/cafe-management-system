<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $appName }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Mobile App Layout -->
        <div class="min-h-screen flex flex-col">
            <!-- Top Navigation Bar - Fixed -->
            @include('layouts.navigation')

            <!-- Page Content - Scrollable -->
            <main class="flex-1 overflow-y-auto pb-20">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

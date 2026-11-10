<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kosku - Manajemen Kost')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            @import url('https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700');
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        </style>
    @endif
</head>
<body class="bg-gradient-to-br from-[#ffffff] to-[#f3f4f6] dark:from-[#0a0a0a] dark:to-[#161615] text-[#000000] dark:text-[#EDEDEC] min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-[#111111] to-[#1b1b18] dark:from-[#161615] dark:to-[#0a0a0a] backdrop-blur-md border-b border-[#85594F33] dark:border-[#3E3E3A] shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-[#00d47a] to-[#00a65a] hover:from-[#f53003] hover:to-[#FF4433] transition-colors">
                        Kosku
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <button type="button" onclick="location.reload()" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#009548] text-white shadow-md hover:shadow-lg hover:scale-105 transition-all">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                           <path d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div data-flash-success class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-sm transition-opacity">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="relative rounded-2xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-gradient-to-br from-white to-gray-50 dark:from-[#0a0a0a] dark:to-[#161615] shadow-2xl p-6 md:p-8">
            <div class="pointer-events-none absolute -top-16 -right-16 w-64 h-64 rounded-full bg-[#009548]/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 w-64 h-64 rounded-full bg-[#85594F]/10 blur-3xl"></div>
        @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-[#ffffff] to-[#f3f4f6] dark:from-[#161615] dark:to-[#0a0a0a] border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                &copy; {{ date('Y') }} Kosku. All rights reserved.
            </p>
        </div>
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var els = document.querySelectorAll('[data-flash-success]');
        if (!els || !els.length) return;
        setTimeout(function () {
            els.forEach(function(el){
                el.style.transition = 'opacity 300ms';
                el.style.opacity = '0';
                setTimeout(function(){ var p=el.parentElement; if(p) p.style.display='none'; else el.style.display='none'; }, 300);
            });
        }, 1000);
    });
    </script>
</body>
</html>

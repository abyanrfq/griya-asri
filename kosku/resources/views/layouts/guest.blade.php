<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GriyaAsri - Cari Kost Nyaman')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <script>
        (function(){
            try {
                var s = localStorage.getItem('theme');
                var d = (!s && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) || s==='dark';
                if (d) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');
            } catch(e) {}
        })();
    </script>

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            @import url('https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            }
        </style>
    @endif
</head>

<body class="bg-bg dark:bg-paper-dark text-text dark:text-text-dark min-h-screen flex flex-col transition-colors duration-300">
   <!-- Navigation dengan Animasi -->
<nav class="bg-gradient-to-b from-bg/90 to-bg/70 dark:from-surface-dark/90 dark:to-surface-dark/70 backdrop-blur-md border-b border-secondary/20 dark:border-border-dark sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-text dark:bg-text-dark rounded-lg flex items-center justify-center text-white dark:text-text font-bold text-lg group-hover:scale-110 transition-transform">
                    A
                </div>
                <span class="text-xl font-bold text-text dark:text-text-dark">
                    GriyaAsri
                </span>
            </a>

            <!-- Theme Toggle Button dengan Animasi -->
            <button id="theme-toggle"
                    type="button"
                    aria-label="Toggle theme"
                    role="button"
                    tabindex="0"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-md border border-border dark:border-border-dark text-text dark:text-text-dark hover:bg-bg/60 dark:hover:bg-surface-dark/60 transition-all duration-200 cursor-pointer active:scale-95 focus:outline-none focus:ring-2 focus:ring-brand/30 relative z-50 group">

                <!-- Sun Icon dengan Pulse Animation -->
                <svg class="w-5 h-5 block dark:hidden group-hover:scale-110 transition-transform duration-200"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     aria-hidden="true">
                    <defs>
                        <linearGradient id="sunGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#f59e0b" />
                            <stop offset="50%" style="stop-color:#fbbf24" />
                            <stop offset="100%" style="stop-color:#fde68a" />
                        </linearGradient>
                        <radialGradient id="pulseEffect" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" style="stop-color:#fef3c7;stop-opacity:0.3" />
                            <stop offset="100%" style="stop-color:#f59e0b;stop-opacity:0" />
                        </radialGradient>
                    </defs>

                    <!-- Pulse Effect -->
                    <circle cx="12" cy="12" r="7" fill="url(#pulseEffect)" opacity="0">
                        <animate attributeName="opacity" values="0;0.4;0" dur="3s" repeatCount="indefinite" />
                        <animate attributeName="r" values="7;9;7" dur="3s" repeatCount="indefinite" />
                    </circle>

                    <!-- Heroicons Sun -->
                    <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"
                          fill="url(#sunGradient)" />
                </svg>

                <!-- Moon Icon dengan Fade Animation -->
                <svg class="w-5 h-5 hidden dark:block group-hover:scale-110 transition-transform duration-200"
                     viewBox="0 0 24 24"
                     fill="currentColor"
                     aria-hidden="true">
                    <defs>
                        <linearGradient id="moonGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#c7d2fe" />
                            <stop offset="50%" style="stop-color:#818cf8" />
                            <stop offset="100%" style="stop-color:#6366f1" />
                        </linearGradient>
                    </defs>

                    <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"
                          fill="url(#moonGradient)">
                        <animate attributeName="opacity" values="0.9;1;0.9" dur="4s" repeatCount="indefinite" />
                    </path>
                </svg>
            </button>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>


   <!-- Footer -->
@if(Route::currentRouteName() === 'home')
<footer class="bg-bg dark:bg-surface-dark border-t border-border dark:border-border-dark mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-brand dark:bg-transparent text-white dark:text-text-dark rounded-md">
        <div class="pt-8 border-t border-white/30 dark:border-border-dark">
            <div class="flex justify-center items-center gap-6 text-center">
                <p class="text-sm text-white dark:text-muted-dark">© 2026 GriyaAsri. All rights reserved.</p>

                <a href="#"
                   onclick="validateAdminToken(event)"
                   class="text-sm text-white dark:text-muted-dark hover:text-white dark:hover:text-brand transition-colors cursor-pointer">
                    Admin
                </a>
            </div>
        </div>
    </div>
</footer>

<script>
async function validateAdminToken(event) {
    event.preventDefault();

    // Ambil CSRF token dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    if (!csrfToken) {
        alert('CSRF token tidak ditemukan. Refresh halaman.');
        return;
    }

    // Tampilkan prompt untuk token
    const token = prompt('Akses Admin');

    if (token === null) return;

    const inputToken = token.trim();
    if (!inputToken) {
        alert('Token tidak boleh kosong!');
        return;
    }

    // Tampilkan loading
    const button = event.target;
    const originalText = button.textContent;
    button.textContent = 'Verifikasi...';
    button.classList.add('opacity-50', 'cursor-not-allowed');

    try {
        // Kirim token ke server untuk validasi
        const response = await fetch("{{ route('validate.token') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ token: inputToken })
        });

        // Cek status response
        if (!response.ok) {
            if (response.status === 401) {
                const data = await response.json();
                throw new Error(data.message || 'Gagal');
            } else if (response.status === 419) {
                throw new Error('Session expired. Refresh halaman.');
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            // Token valid, redirect ke login
            alert('Berhasil');
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 500);
        } else {
            // Token invalid
            alert((data.message || 'Gagal!'));
        }

    } catch (error) {
        console.error('Error:', error);
        alert(error.message);
    } finally {
        // Reset button
        button.textContent = originalText;
        button.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}
</script>
@endif
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

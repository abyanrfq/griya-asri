@extends('layouts.guest')

@section('content')
    <!-- Gallery Slider Section -->
    <div id="slider-home"
        class="relative bg-bg dark:bg-paper-dark w-full mt-3"
        style="height: calc(100vh - 4rem);">
        <!-- Slider Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 h-full">
            <div
                class="relative w-full h-full bg-gray-100 dark:bg-surface-dark rounded-2xl overflow-hidden shadow-2xl border border-border dark:border-border-dark">
                <div
                    class="bs-slider-overlay absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/40 dark:from-black/40 dark:via-black/20 dark:to-black/50 pointer-events-none z-10 rounded-2xl">
                </div>
                <div id="gallery-main" class="relative h-full w-full overflow-hidden rounded-2xl">
                    @php
                        $first = (isset($galleries) && $galleries->count() > 0) ? $galleries->first() : null;
                    @endphp
                    @if($first)
                        <!-- Container untuk gambar dengan fixed size -->
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-800">
                            <img id="main-image" src="{{ asset('storage/' . $first->image_path) }}"
                                alt="{{ $first->title ?? 'Gallery Image' }}" class="w-full h-full object-cover" loading="eager"
                                onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23e5e7eb%22 width=%22400%22 height=%22400%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%239ca3af%22 font-family=%22sans-serif%22 font-size=%2218%22%3EImage%3C/text%3E%3C/svg%3E';">
                        </div>

                        <button id="gallery-prev" type="button" aria-label="Sebelumnya"
                            class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 z-30 inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-brand text-white shadow-lg hover:bg-brand/90 focus:outline-none">
                            <svg class="w-6 h-6 md:w-7 md:h-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="gallery-next" type="button" aria-label="Berikutnya"
                            class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 z-30 inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-brand text-white shadow-lg hover:bg-brand/90 focus:outline-none">
                            <svg class="w-6 h-6 md:w-7 md:h-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12 text-center z-20">
                            <h3 id="main-title"
                                class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 drop-shadow-lg">
                                {{ $first->title ?? '' }}</h3>
                            <p id="main-desc"
                                class="text-white/90 text-sm md:text-base max-w-2xl mx-auto drop-shadow-md {{ $first->description ? '' : 'hidden' }}">
                                {{ $first->description ?? '' }}</p>
                            @if(isset($galleries) && $galleries->count() > 0)
                                <div class="mt-4" id="gallery-preview">
                                    <ul class="flex flex-wrap gap-2 justify-center">
                                        @foreach($galleries->take(8) as $index => $gallery)
                                            @php
                                                $title = $gallery->title ?: 'Gambar ' . ($index + 1);
                                                $shortTitle = Str::length($title) > 10 ? Str::substr($title, 0, 10) . '...' : $title;
                                            @endphp

                                            <li data-target="#gallery-preview" data-slide-to="{{ $index }}" style="text-indent: 0"
                                                class="preview-indicator px-4 py-2 rounded-full text-xs md:text-sm font-medium transition-all border {{ $index === 0 ? 'active bg-brand text-white border-brand shadow' : 'backdrop-blur-md bg-white/20 dark:bg-white/10 text-white border-white/30 dark:border-white/20 hover:bg-brand/20 hover:text-white shadow-sm' }}"
                                                @if($gallery->title && Str::length($gallery->title) > 10) title="{{ $gallery->title }}" @endif>

                                                {{ $shortTitle }}

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-br from-orange-100 to-red-100 dark:from-surface-dark dark:to-text border border-orange-200 dark:border-border-dark flex items-center justify-center">
                            <div class="text-center px-4">
                                <svg class="w-24 h-24 mx-auto text-orange-600 dark:text-orange-400 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="text-2xl font-bold text-text dark:text-text-dark mb-2">Galeri Kost</h3>
                                <p class="text-muted dark:text-muted-dark">Tambahkan gambar galeri melalui admin panel</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    @php
        $data = ($galleries ?? collect())->map(function ($g) {
            return [
                'src' => asset('storage/' . $g->image_path),
                'title' => $g->title,
                'description' => $g->description,
            ];
        })->values();
    @endphp
    <script type="application/json" id="gallery-data">@json($data)</script>
    @verbatim
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const raw = document.getElementById('gallery-data');
                const data = raw ? JSON.parse(raw.textContent || '[]') : [];
                const mainImage = document.getElementById('main-image');
                const mainTitle = document.getElementById('main-title');
                const mainDesc = document.getElementById('main-desc');
                const previewIndicators = document.querySelectorAll('.preview-indicator');
                const prevBtn = document.getElementById('gallery-prev');
                const nextBtn = document.getElementById('gallery-next');
                let currentMain = 0;

                function setMain(index) {
                    if (!data || !data[index] || !mainImage) return;
                    mainImage.src = data[index].src;
                    if (mainTitle) {
                        const t = data[index].title || '';
                        mainTitle.textContent = t;
                        if (t) { mainTitle.classList.remove('hidden'); } else { mainTitle.classList.add('hidden'); }
                    }
                    if (mainDesc) {
                        const d = data[index].description || '';
                        mainDesc.textContent = d;
                        if (d) { mainDesc.classList.remove('hidden'); } else { mainDesc.classList.add('hidden'); }
                    }
                    currentMain = index;
                }

                function updateIndicators(activeIndex) {
                    previewIndicators.forEach((el, i) => {
                        if (i === activeIndex) {
                            el.classList.remove('backdrop-blur-md', 'bg-white/20', 'dark:bg-white/10', 'text-white', 'border-white/30', 'dark:border-white/20', 'hover:bg-brand/20', 'hover:text-white', 'shadow-sm');
                            el.classList.add('active', 'bg-brand', 'text-white', 'border-brand', 'shadow');
                        } else {
                            el.classList.remove('active', 'bg-brand', 'text-white', 'border-brand', 'shadow');
                            el.classList.add('backdrop-blur-md', 'bg-white/20', 'dark:bg-white/10', 'text-white', 'border-white/30', 'dark:border-white/20', 'hover:bg-brand/20', 'hover:text-white', 'shadow-sm');
                        }
                    });
                }

                previewIndicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        setMain(index);
                        updateIndicators(index);
                    });
                });

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        if (!data.length) return;
                        const nextIndex = (currentMain - 1 + data.length) % data.length;
                        setMain(nextIndex);
                        updateIndicators(nextIndex);
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        if (!data.length) return;
                        const nextIndex = (currentMain + 1) % data.length;
                        setMain(nextIndex);
                        updateIndicators(nextIndex);
                    });
                }

                setMain(0);
                updateIndicators(0);

                const nav = document.querySelector('nav');
                const stackContainer = document.getElementById('features-grid');
                const stackCards = stackContainer ? stackContainer.querySelectorAll('[data-stack-card]') : [];

                function setupStackCards() {
                    if (!nav || !stackCards.length) return;
                    const navHeight = nav.offsetHeight || 0;
                    const topOffset = navHeight + 4;
                    stackCards.forEach((card, index) => {
                        card.style.position = 'sticky';
                        card.style.top = topOffset + 'px';
                        card.style.zIndex = String(10 + index);
                        card.style.marginTop = index === 0 ? '0px' : String(index * 40) + 'px';
                    });
                }

                setupStackCards();
                window.addEventListener('resize', setupStackCards);
            });
        </script>
    @endverbatim

    <!-- Hero Section -->
    <div class="relative bg-paper dark:bg-paper-dark overflow-hidden">
        <!-- Decorative Elements -->

<br>
        <h1
            class="text-4xl md:text-6xl font-bold text-text dark:text-text-dark mb-6 tracking-tight leading-tight text-center">
            <span class="block mt-8 text-transparent bg-clip-text bg-gradient-to-r from-brand to-secondary">Temukan Kenyamanan</span>
            

        </h1>




    </div>

    <!-- Features Grid -->
    <div id="features-grid" class="max-w-5xl mx-auto space-y-8 lg:space-y-16 py-16 lg:py-24 relative">
        <!-- Lokasi Strategis -->
        <div data-stack-card
            class="group p-6 rounded-2xl bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark shadow-lg dark:shadow-none transition-shadow sticky top-24 z-10">
            <div
                class="w-12 h-12 rounded-xl flex items-center justify-center text-brand mb-4 transition-transform duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-text dark:text-text-dark mb-3">Lokasi Strategis</h3>

            <ul class="space-y-2 text-muted dark:text-muted-dark text-sm">
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 text-brand flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Kampus UPN Veteran Jawa Timur <span class="text-brand dark:text-brand font-medium">(3
                            menit)</span></span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 text-brand flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>STAI Taruna Surabaya Kampus 2 <span class="text-brand dark:text-brand font-medium">(9
                            menit)</span></span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 text-brand flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>SIER (Surabaya Industrial Estate) <span class="text-brand dark:text-brand font-medium">(8
                            menit)</span></span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 text-brand flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span> Akses Tol Rungkut<span class="text-brand dark:text-brand font-medium"> (7 menit)</span> </span>
                </li>
            </ul>
        </div>

        <!-- Fasilitas Lengkap -->
        <div data-stack-card
            class="group p-6 rounded-2xl bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark shadow-lg dark:shadow-none transition-shadow sticky top-24 z-20 mt-10">
            <div
                class="w-12 h-12 flex items-center justify-center text-blue-500 mb-4 transition-transform duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-text dark:text-text-dark mb-3">Fasilitas </h3>

            <div class="space-y-3">
                <div class="p-3 rounded-lg">
                    <h4 class="font-semibold text-text dark:text-text-dark mb-1 text-sm">Kamar Eksklusif</h4>
                    <p class="text-xs text-muted dark:text-muted-dark">
                        AC, tempat tidur, lemari, meja belajar, kamar mandi dalam, dan dapur bersama.
                    </p>
                </div>

                <div class="p-3 rounded-lg">
                    <h4 class="font-semibold text-text dark:text-text-dark mb-1 text-sm">Konektivitas</h4>
                    <p class="text-xs text-muted dark:text-muted-dark">
                        WiFi high-speed up to 50 Mbps setiap lantai
                    </p>
                </div>

                <div class="p-3 rounded-lg">
                    <h4 class="font-semibold text-text dark:text-text-dark mb-1 text-sm">Keamanan &amp; Parkir</h4>
                    <p class="text-xs text-muted dark:text-muted-dark">
                        CCTV 24 jam, penjaga, area parkir luas untuk motor
                    </p>
                </div>
            </div>
        </div>

        <!-- Harga  -->
        <div data-stack-card
            class="group p-6 rounded-2xl bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark shadow-lg dark:shadow-none transition-shadow sticky top-24 z-30 mt-20">
            <div
                class="w-12 h-12 rounded-xl flex items-center justify-center text-green-500 mb-4 transition-transform duration-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-text dark:text-text-dark mb-3">Harga Terjangkau</h3>

            <div class="mb-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-text dark:text-text-dark">Rp 1.600.000</span>
                    <span class="text-muted dark:text-muted-dark">/bulan</span>
                </div>
                <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                    All-inclusive (air, WiFi, kebersihan)
                </p>
            </div>



        </div>
    </div>

    <!-- Stats Section dengan garis pemisah -->
    <div class="py-16 md:py-20 bg-paper dark:bg-paper-dark">
        <div class="max-w-5xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="text-center md:border-r md:border-gray-200 dark:md:border-gray-700 md:pr-8">
                    <div class="text-xl font-bold text-brand mb-3">10+</div>
                    <div class="text-xl text-muted dark:text-muted-dark">Kamar Tersedia</div>
                </div>

                <div class="text-center md:border-r md:border-gray-200 dark:md:border-gray-700 md:px-8">
                    <div class="text-xl font-bold text-brand mb-3">24/7</div>
                    <div class="text-xl text-muted dark:text-muted-dark">Keamanan</div>
                </div>

                <div class="text-center md:pl-8">
                    <div class="text-xl font-bold text-brand mb-3">100%</div>
                    <div class="text-xl text-muted dark:text-muted-dark">Kepuasan</div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    <!-- CTA Section -->
    <!-- CTA Section dengan footer di dalamnya -->
    <div
        class="py-16 md:py-20 lg:py-24 mb-16 md:mb-20 bg-paper dark:bg-paper-dark text-text dark:text-text-dark relative overflow-hidden">

        <!-- Hiasan blur -->
        <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-green-500/20 blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl font-bold mb-4 text-text dark:text-text-dark">Punya Pertanyaan?</h2>
            <p class="text-lg text-secondary dark:text-muted-dark mb-6">
                Kami siap membantu! Jangan ragu untuk menghubungi kami melalui kontak di bawah ini
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-3 mb-12">
                <br>
                <br>
                <!-- Tombol Lokasi -->
                <a href="https://maps.google.com/?q=Jl.%20Rungkut%20Asri%20Timur%20XIII%20No.90,%20Rungkut%20Kidul,%20Surabaya"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-[#000000] text-[#ffffff] border border-[#000000] hover:bg-[#000000E6] dark:bg-[#ffffff] dark:text-[#000000] dark:border-[#ffffff] dark:hover:bg-[#ffffffE6] text-sm w-full sm:w-auto shadow-sm hover:shadow-md">
                    <img src="https://pngimg.com/uploads/google_maps_pin/google_maps_pin_PNG26.png" alt="Lokasi" class="w-4 h-5 object-contain align-middle shrink-0 mt-0.5" onerror="this.style.display='none'">
                    <span class="truncate">Jl. Rungkut Asri Timur...</span>
                </a>
                <br>


                <!-- Tombol Mamikos -->
                <a href="https://mamikos.com/room/kost-surabaya-kost-putri-eksklusif-kost-griya-asri-rungkut-surabaya"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-full font-semibold transition-colors shadow-md hover:shadow-lg text-sm w-full sm:w-auto
                           bg-[#009548] text-white
                           dark:bg-[#009548] dark:text-white
                           hover:bg-[#00833f]">
                    <img src="{{ asset('images/mamikos-icon.png') }}" alt="Mamikos" class="w-6 h-6.5 object-contain mt-0.5" onerror="this.style.display='none'">
                    <span class="ml-1">Mamikos</span>
                </a>
                <br>
                <!-- Tombol WhatsApp -->
                <a href="https://api.whatsapp.com/send/?phone=+6282143269626&text=Halo%2C+saya+tertarik+dengan+kost+ini"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-brand hover:bg-brand/90 text-white rounded-full font-semibold transition-colors shadow-md hover:shadow-lg border-2 border-brand text-sm w-full sm:w-auto">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
                        </path>
                    </svg>
                    <span class="ml-1">WhatsApp</span>
                </a>

            </div>

        </div>


    </div>
    </div>
@endsection

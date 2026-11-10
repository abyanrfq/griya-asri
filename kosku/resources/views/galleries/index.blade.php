@extends('layouts.app')

@section('title', 'Kelola Galeri - Kosku')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Kelola Galeri</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A]">Kelola gambar galeri untuk ditampilkan di landing page</p>
        </div>
        <a href="{{ route('galleries.create') }}" class="px-6 py-3 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] rounded-sm hover:bg-[#f53003] dark:hover:bg-white transition-colors font-medium">
            + Tambah Gambar
        </a>
    </div>

    @if($galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-square bg-gray-200 dark:bg-gray-800 overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                             alt="{{ $gallery->title ?? 'Gallery Image' }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        @if($gallery->title)
                            <h3 class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-1">{{ $gallery->title }}</h3>
                        @endif
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mb-3">Order: {{ $gallery->order }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('galleries.edit', $gallery) }}" 
                               class="flex-1 px-3 py-2 text-center text-xs font-medium border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] rounded-sm hover:bg-gray-50 dark:hover:bg-[#3E3E3A] transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('galleries.destroy', $gallery) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus gambar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 text-xs font-medium bg-red-500 text-white rounded-sm hover:bg-red-600 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-gray-50 dark:bg-gray-900/30 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
            <svg class="mx-auto h-16 w-16 text-[#706f6c] dark:text-[#A1A09A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Belum ada gambar di galeri</h3>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6">Tambahkan gambar pertama untuk ditampilkan di landing page</p>
            <a href="{{ route('galleries.create') }}" class="inline-block px-6 py-3 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] rounded-sm hover:bg-[#f53003] dark:hover:bg-white transition-colors font-medium">
                Tambah Gambar Pertama
            </a>
        </div>
    @endif
</div>
@endsection

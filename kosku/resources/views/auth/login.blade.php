@extends('layouts.guest')

@section('title', 'Login Admin - Kosku')

@section('content')
<div class="max-w-sm mx-auto px-3 py-10">
    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-2xl shadow-sm p-6">
        <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Login Admin</h1>
        @if(session('success'))
            <div data-flash-success class="mb-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-sm transition-opacity">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-sm">
                {{ $errors->first('login') }}
            </div>
        @endif
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Username
                </label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent" placeholder="Masukkan username" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Password
                </label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] rounded-sm hover:bg-[#f53003] dark:hover:bg-white transition-colors font-medium">
                Masuk
            </button>
        </form>
        
    </div>
</div>
@endsection

<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Guest / Public Routes
Route::get('/', [GuestController::class, 'index'])->name('home');

// Auth (Login) - minimal form page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt(['name' => $data['username'], 'password' => $data['password']], false)) {
        $request->session()->regenerate();
        return redirect()->route('galleries.index')->with('success', 'Berhasil login sebagai admin.');
    }

    return back()->withErrors(['login' => 'Username atau password salah'])->withInput();
})->name('login.submit');
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// Admin Routes
Route::resource('galleries', GalleryController::class)->middleware('auth');


use App\Models\AdminToken;


Route::post('/validate-admin-token', function (Request $request) {
    $request->validate([
        'token' => 'required|string|max:50'
    ]);

    // Validasi token dari database
    $isValid = AdminToken::isValid($request->token);

    if ($isValid) {
        // Simpan di session bahwa token valid
        session(['admin_token_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Token valid, mengarahkan ke login...'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Gagal!'
    ], 401);
})->name('validate.token');



// ... route lainnya ...

// Route untuk validasi token
Route::post('/validate-admin-token', function (Request $request) {
    $request->validate([
        'token' => 'required|string|max:50'
    ]);

    // Validasi token dari database
    $isValid = AdminToken::isValid($request->token);

    if ($isValid) {
        // Simpan di session bahwa token valid
        session(['admin_token_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Token valid, mengarahkan ke login...'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Gagal!'
    ], 401);
})->name('validate.token');

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAccessController extends Controller
{
    /**
     * Tampilkan form verifikasi akses
     */
    public function showAccessForm()
    {
        return view('admin.access-form');
    }

    /**
     * Proses verifikasi kode akses
     */
    public function verifyAccess(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string'
        ]);

        // Ambil kode akses dari .env atau config
        $validCode = config('app.admin_access_code', env('ADMIN_ACCESS_CODE'));

        if ($request->access_code === $validCode) {
            // Simpan di session
            Session::put('admin_access_granted', true);
            Session::put('admin_access_time', now());

            // Redirect ke halaman login admin
            return redirect()->route('login');
        }

        return back()->withErrors([
            'access_code' => 'Kode akses tidak valid.'
        ])->withInput();
    }

    /**
     * Logout dari akses admin (clear session)
     */
    public function logoutAccess()
    {
        Session::forget('admin_access_granted');
        Session::forget('admin_access_time');

        return redirect('/')->with('success', 'Akses admin telah ditutup.');
    }
}

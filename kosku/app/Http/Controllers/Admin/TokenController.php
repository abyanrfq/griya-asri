<?php
// File: app/Http\Controllers\Admin\TokenController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = AdminToken::all();
        return view('admin.tokens.index', compact('tokens'));
    }

    public function create()
    {
        return view('admin.tokens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'token' => 'required|string|max:50|unique:admin_tokens'
        ]);

        AdminToken::create([
            'name' => $request->name,
            'token' => strtoupper($request->token),
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.tokens.index')
            ->with('success', 'Token berhasil dibuat!');
    }

    public function destroy(AdminToken $token)
    {
        $token->delete();
        return back()->with('success', 'Token dihapus!');
    }
}

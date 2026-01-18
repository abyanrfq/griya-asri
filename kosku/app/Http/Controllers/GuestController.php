<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display the landing page with available rooms.
     */
    public function index()
    {
        // Get gallery images
        $galleries = \App\Models\Gallery::orderBy('order')->latest()->get();
            
        return view('landing', compact('galleries'));
    }

    /**
     * Display the specified room details for guests.
     */
    public function show(Room $room)
    {
        // Check if room is available, or just show it anyway so they can see details?
        // Usually promotional sites show everything, but let's stick to what's logical.
        // If it's not deleted soft-delete style, we show it.
        $room->load('images');
        return view('guest.show', compact('room'));
    }
}

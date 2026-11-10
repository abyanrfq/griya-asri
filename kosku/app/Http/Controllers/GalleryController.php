<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order')->latest()->get();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'image_path' => $path,
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('galleries.index')
            ->with('success', 'Gambar berhasil ditambahkan ke galeri.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $updateData = [
            'title' => $validated['title'] ?? $gallery->title,
            'description' => $validated['description'] ?? $gallery->description,
            'order' => $validated['order'] ?? $gallery->order,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path && file_exists(storage_path('app/public/' . $gallery->image_path))) {
                unlink(storage_path('app/public/' . $gallery->image_path));
            }
            $updateData['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($updateData);

        return redirect()->route('galleries.index')
            ->with('success', 'Gambar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image_path && file_exists(storage_path('app/public/' . $gallery->image_path))) {
            unlink(storage_path('app/public/' . $gallery->image_path));
        }

        $gallery->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Gambar berhasil dihapus dari galeri.');
    }
}

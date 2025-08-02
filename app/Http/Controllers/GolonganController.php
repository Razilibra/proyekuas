<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $golongan = Golongan::all(); // Mengambil semua data dari tabel golongan
        return view('admin.golongan.index', compact('golongan')); // Tampilkan view index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.golongan.create'); // Tampilkan form untuk menambahkan golongan baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_golongan' => 'required|string|max:255',
        ]);

        Golongan::create([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $golongan = Golongan::findOrFail($id); // Cari data berdasarkan ID
        return view('admin.golongan.edit', compact('golongan')); // Tampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_golongan' => 'required|string|max:255',
        ]);

        $golongan = Golongan::findOrFail($id);
        $golongan->update([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();

        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil dihapus.');
    }
}

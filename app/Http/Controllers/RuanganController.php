<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('admin.ruangan.index', compact('ruangan'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.ruangan.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|',
            'nama_ruangan' => 'required|',
            'keterangan' => 'required|',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')
                         ->with('success', 'Ruangan created successfully.');
    }

    // Display the specified resource.
    public function show(Ruangan $ruangan)
    {
        // return view('admin.ruangan.show', compact('ruangan'));
    }

    // Show the form for editing the specified resource.
    public function edit(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode_ruangan' => 'required|',
            'nama_ruangan' => 'required|',
            'keterangan' => 'required|',
        ]);

        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')
                         ->with('success', 'Ruangan updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')
                         ->with('success', 'Ruangan deleted successfully.');
    }
}

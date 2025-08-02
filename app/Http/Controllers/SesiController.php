<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index()
    {
        $sesi = Sesi::all();
        return view('admin.sesi.index', compact('sesi'));
    }

    public function create()
    {
        return view('admin.sesi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_sesi' => 'required|max:255',
            'nama_sesi' => 'required|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
            'keterangan' => 'nullable|max:255',
        ]);

        Sesi::create($request->all());

        return redirect()->route('sesi.index')
                         ->with('success', 'Sesi berhasil dibuat.');
    }

    public function show(Sesi $sesi)
    {
        return view('admin.sesi.show', compact('sesi'));
    }

    public function edit(Sesi $sesi)
    {
        return view('admin.sesi.edit', compact('sesi'));
    }

    public function update(Request $request, Sesi $sesi)
    {
        $request->validate([
            'kode_sesi' => 'required|max:255',
            'nama_sesi' => 'required|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
            'keterangan' => 'nullable|max:255',
        ]);

        $sesi->update($request->all());

        return redirect()->route('sesi.index')
                         ->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroy(Sesi $sesi)
    {
        $sesi->delete();

        return redirect()->route('sesi.index')
                         ->with('success', 'Sesi berhasil dihapus.');
    }
}

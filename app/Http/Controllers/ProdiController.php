<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::with(['jenjang', 'jurusan'])->get();

        return view('admin.prodi.index', compact('prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $jenjang = Jenjang::all();

        return view('admin.prodi.create', compact('jurusan', 'jenjang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_jenjang' => 'required|exists:jenjang,id_jenjang',
        ]);

        Prodi::create($validated);

        return redirect()->route('prodi.index')->with('success', 'Data Prodi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $prodi = Prodi::with(['jenjang', 'jurusan'])->findOrFail($id);
        $jurusan = Jurusan::all();
        $jenjang = Jenjang::all();

        return view('admin.prodi.edit', compact('prodi', 'jurusan', 'jenjang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_jenjang' => 'required|exists:jenjang,id_jenjang',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($validated);

        return redirect()->route('prodi.index')->with('success', 'Data Prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Data Prodi berhasil dihapus.');
    }
}

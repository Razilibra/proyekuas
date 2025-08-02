<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data Tempat PKL
        $tempat_pkl = TempatPkl::all();
        return view('admin.tempatpkl.index', compact('tempat_pkl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tempatpkl.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        // Tentukan status berdasarkan kuota
        $validatedData['status'] = $validatedData['kuota'] > 0;

        // Simpan data
        TempatPkl::create($validatedData);

        return redirect()->route('tempat_pkl.index')->with('success', 'Data Tempat PKL berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TempatPkl $tempatPkl)
    {
        return view('admin.tempatpkl.show', compact('tempatPkl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tempatPkl = TempatPkl::findOrFail($id); // Ambil data berdasarkan ID
        return view('admin.tempatpkl.edit', compact('tempatPkl'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempatPkl $tempatPkl)
    {
        $validatedData = $this->validateRequest($request);

        // Tentukan status berdasarkan kuota
        $validatedData['status'] = $validatedData['kuota'] > 0;

        // Update data
        $tempatPkl->update($validatedData);

        return redirect()->route('tempat_pkl.index')->with('success', 'Data Tempat PKL berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempatPkl $tempatPkl)
    {
        // Hapus data
        $tempatPkl->delete();

        return redirect()->route('tempat_pkl.index')->with('success', 'Data Tempat PKL berhasil dihapus!');
    }

    /**
     * Validate the incoming request.
     */
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'kuota' => 'required|integer|min:0', // kuota minimal 0
        ]);
    }
}

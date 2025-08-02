<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    public function index(){
        $bimbingan=bimbingan::all();
        return view('bimbingan.bimbingan', compact('bimbingan'));
    }

    public function create()
    {
        $dosens= dosen::all();
        $mahasiswas = mahasiswa::all();

        return view('bimbingan.bimbingancreate', compact('dosens', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        // Logic to store bimbingan data
        $request->validate([
            'pembahasan' => 'required|string',
            'dosen_id' => 'required|exists:dosens,id', // Ensure correct table name
            'mahasiswa_id' => 'required|exists:mahasiswas,id', // Ensure correct table name
        ]);

        Bimbingan::create($request->all());
        return redirect()->route('bimbingan.bimbingan')->with('success', 'Bimbingan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $dosen = Dosen::all(); // Fetch all dosen for edit view
        $mahasiswa = mahasiswa::all(); // Fetch all mahasiswas for edit view

        return view('bimbingan.bimbinganedit', compact('bimbingan', 'dosen', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update bimbingan data
        $request->validate([
            'pembahasan' => 'required|string',
            'dosen_id' => 'required|exists:dosens,id', // Ensure correct table name
            'mahasiswa_id' => 'required|exists:mahasiswas,id', // Ensure correct table name
        ]);

        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->update($request->all());
        return redirect()->route('bimbingan.bimbingan')->with('success', 'Bimbingan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->delete();
        return redirect()->route('bimbingan.bimbingan')->with('success', 'Bimbingan berhasil dihapus.');
    }
}

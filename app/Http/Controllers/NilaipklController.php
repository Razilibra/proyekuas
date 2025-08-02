<?php

namespace App\Http\Controllers;

use App\Models\Nilaipkl;
use App\Models\Dosen;
use App\Models\MahasiswaPkl;
use Illuminate\Http\Request;

class NilaipklController extends Controller
{
    // Menampilkan halaman daftar nilai PKL
    public function index()
    {
        
        $nilai_pkl = Nilaipkl::with(['dosen', 'mahasiswaPkl'])->get(); // Eager load dosen and mahasiswaPkl relationships
        return view('admin.nilaipkl.index', compact('nilai_pkl'));
    }

    // Menampilkan form untuk menambah nilai PKL
    public function create()
    {
        $dosens = Dosen::all(); // Ambil semua dosen
        $mahasiswa_pkl = MahasiswaPkl::all(); // Ambil semua mahasiswa PKL
        return view('admin.nilaipkl.create', compact('dosens', 'mahasiswa_pkl'));
    }

    // Menyimpan data nilai PKL
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl',
            'keaktifan_bimbingan' => 'nullable|string',
            'komunikatif' => 'nullable|string',
            'problem_solving' => 'nullable|string',
            'total_nilai' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan nilai PKL baru
        Nilaipkl::create($request->all());

        return redirect()->route('nilaipkl.index')->with('success', 'Nilai PKL berhasil ditambahkan.');
    }

    // Menampilkan detail nilai PKL
    public function show($id)
    {
        $nilaipkl = Nilaipkl::findOrFail($id); // Cari nilai PKL berdasarkan ID
        return view('admin.nilaipkl.show', compact('nilaipkl'));
    }

    // Menampilkan form untuk mengedit nilai PKL
    public function edit($id)
    {
        $nilaipkl = Nilaipkl::findOrFail($id); // Cari nilai PKL berdasarkan ID
        $dosens = Dosen::all(); // Ambil semua dosen
        $mahasiswaPkl = MahasiswaPkl::all(); // Ambil semua mahasiswa PKL
        return view('admin.nilaipkl.edit', compact('nilaipkl', 'dosens', 'mahasiswaPkl'));
    }

    // Menyimpan perubahan nilai PKL
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl',
            'keaktifan_bimbingan' => 'nullable|string',
            'komunikatif' => 'nullable|string',
            'problem_solving' => 'nullable|string',
            'total_nilai' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        // Cari nilai PKL berdasarkan ID dan update
        $nilaipkl = Nilaipkl::findOrFail($id);
        $nilaipkl->update($request->all());

        return redirect()->route('nilaipkl.index')->with('success', 'Nilai PKL berhasil diperbarui.');
    }

    // Menghapus nilai PKL
    public function destroy($id)
    {
        $nilaipkl = Nilaipkl::findOrFail($id); // Cari nilai PKL berdasarkan ID
        $nilaipkl->delete();

        return redirect()->route('nilaipkl.index')->with('success', 'Nilai PKL berhasil dihapus.');
    }
}

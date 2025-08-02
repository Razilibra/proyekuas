<?php

namespace App\Http\Controllers;

use App\Models\LaporanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanPklController extends Controller
{
    public function index()
    {
        $laporan_pkl = LaporanPkl::all();
        return view('admin.laporanpkl.index', compact('laporan_pkl'));
    }

    public function create()
    {
        return view('admin.laporanpkl.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nobp' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'file' => 'required|file',
            'tahun_ajaran' => 'required',
        ]);

        // Simpan file di storage/app/files
        $path = $request->file('file')->store('files');

        // Simpan data laporan
        LaporanPkl::create([
            'nobp' => $request->nobp,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'file' => $path,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()->route('laporan_pkl.index')->with('success', 'Laporan PKL berhasil ditambahkan');
    }

    public function download($id)
    {
        $laporan_pkl = LaporanPkl::findOrFail($id);

        // Cek apakah file ada
        if (Storage::exists($laporan_pkl->file)) {
            return response()->file(storage_path('app/' . $laporan_pkl->file));
        }

        return redirect()->route('laporan_pkl.index')->with('error', 'File tidak ditemukan');
    }

    public function edit($id)
    {
        $laporan_pkl = LaporanPkl::findOrFail($id);
        return view('admin.laporanpkl.edit', compact('laporan_pkl'));
    }

    public function update(Request $request, $id)
    {
        $laporan_pkl = LaporanPkl::findOrFail($id);

        $request->validate([
            'nobp' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'file' => 'nullable|file',
            'tahun_ajaran' => 'required',
        ]);

        $data = $request->only(['nobp', 'nama', 'prodi', 'nama_perusahaan', 'alamat']);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($laporan_pkl->file) {
                Storage::delete($laporan_pkl->file);
            }

            // Simpan file baru di storage/app/files
            $data['file'] = $request->file('file')->store('files');
        }

        $laporan_pkl->update($data);

        return redirect()->route('laporan_pkl.index')->with('success', 'Laporan PKL berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan_pkl = LaporanPkl::findOrFail($id);

        // Hapus file jika ada
        if ($laporan_pkl->file) {
            Storage::delete($laporan_pkl->file);
        }

        $laporan_pkl->delete();

        return redirect()->route('laporan_pkl.index')->with('success', 'Laporan PKL berhasil dihapus');
    }
}

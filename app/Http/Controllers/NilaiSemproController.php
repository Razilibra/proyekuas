<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\pengajuan;
use App\Models\nilai_sempro;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class NilaiSemproController extends Controller
{
    public function index(Request $request)
    {

        $nilaisempro = nilai_sempro::all();

        return view('admin.nilai_sempro.index', compact('nilaisempro'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::all();
        return view('admin.nilai_sempro.create', compact('pengajuans', 'dosens'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'jabatan_sidang' => 'required|string',
            'latar_belakang_penelitian' => 'required|string',
            'landasan_teori' => 'required|string',
            'rumusan_masalah' => 'required|string',
            'penyampaian_materi' => 'required|string',
            'pemahaman_materi' => 'required|string',
            'ketepatan_jawaban' => 'required|string',
            'gaya_bahasa' => 'required|string',
            'berpakaian' => 'required|string',
            'sikap_mahasiswa' => 'required|string',
            'komentar' => 'required|string',
            'total_nilai' => 'required|string',

        ]);
        $nilaisempro = nilai_sempro::create([
            'id_dosen' => $validated['id_dosen'],
            'id_pengajuan' => $validated['id_pengajuan'],
            'jabatan_sidang' => $validated['jabatan_sidang'],
            'latar_belakang_penelitian' => $validated['latar_belakang_penelitian'],
            'landasan_teori' => $validated['landasan_teori'],
            'rumusan_masalah' => $validated['rumusan_masalah'],
            'penyampaian_materi' => $validated['penyampaian_materi'],
            'pemahaman_materi' => $validated['pemahaman_materi'],
            'ketepatan_jawaban' => $validated['ketepatan_jawaban'],
            'gaya_bahasa' => $validated['gaya_bahasa'],
            'berpakaian' => $validated['berpakaian'],
            'sikap_mahasiswa' => $validated['sikap_mahasiswa'],
            'komentar' => $validated['komentar'],
            'total_nilai' => $validated['total_nilai'],


        ]);

        $nilaisempro->save();

        return redirect()->route('admin.nilai_sempro.index')->with('success', 'Nilai sempro berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $nilaisempro = nilai_sempro::findOrFail($id);
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::all();
        return view('admin.nilai_sempro.edit', compact('nilaisempro', 'dosens', 'pengajuans'));
    }
    public function update(Request $request, $id)
    {
        $nilaisempro = nilai_sempro::findOrFail($id);

        $validatedData = $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'jabatan_sidang' => 'required|string|max:50',
            'latar_belakang_penelitian' => 'required|integer|min:0|max:100',
            'landasan_teori' => 'required|integer|min:0|max:100',
            'rumusan_masalah' => 'required|integer|min:0|max:100',
            'penyampaian_materi' => 'required|integer|min:0|max:100',
            'pemahaman_materi' => 'required|integer|min:0|max:100',
            'ketepatan_jawaban' => 'required|integer|min:0|max:100',
            'gaya_bahasa' => 'required|integer|min:0|max:100',
            'berpakaian' => 'required|integer|min:0|max:100',
            'sikap_mahasiswa' => 'required|integer|min:0|max:100',
            'komentar' => 'required|string|max:255',
            'total_nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilaisempro->update($validatedData);

        return redirect()
            ->route('admin.nilai_sempro.index')
            ->with('success', 'Nilai sempro berhasil diupdate.');
    }

    public function destroy($id)
    {
        $nilaisempro = nilai_sempro::find($id);
        $nilaisempro->delete();
        return redirect()->route('admin.nilai_sempro.index')->with('success', 'Nilai sempro berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\pengajuan;
use App\Models\nilai_ta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class NilaiTaController extends Controller
{
    public function index(Request $request)
    {

        $nilaita = nilai_ta::all();

        return view('admin.nilai_ta.index', compact('nilaita'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::all();
        return view('admin.nilai_ta.create', compact('pengajuans', 'dosens'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'jabatan_sidang' => 'required|string',
            'sikap_dan_penampilan' => 'required|string',
            'komunikasi_dan_sistematika' => 'required|string',
            'penguasaan_materi' => 'required|string',
            'identifikasi_masalah_tujuan_dan_kontribusi_penelitian' => 'required|string',
            'relevansi_teori' => 'required|string',
            'metode_yang_digunakan' => 'required|string',
            'hasil_dan_pembahasan' => 'required|string',
            'kesimpulan_dan_saran' => 'required|string',
            'penggunaan_bahasa_dan_tata_tulis' => 'required|string',
            'kesesuaian_fungsionalitas_sistem' => 'required|string',
            'revisi' => 'required|string',
            'total_nilai' => 'required|string',


        ]);
        $nilaita = nilai_ta::create([
            'id_dosen' => $validated['id_dosen'],
            'id_pengajuan' => $validated['id_pengajuan'],
            'jabatan_sidang' => $validated['jabatan_sidang'],
            'sikap_dan_penampilan' => $validated['sikap_dan_penampilan'],
            'komunikasi_dan_sistematika' => $validated['komunikasi_dan_sistematika'],
            'penguasaan_materi' => $validated['penguasaan_materi'],
            'identifikasi_masalah_tujuan_dan_kontribusi_penelitian' => $validated['identifikasi_masalah_tujuan_dan_kontribusi_penelitian'],
            'relevansi_teori' => $validated['relevansi_teori'],
            'metode_yang_digunakan' => $validated['metode_yang_digunakan'],
            'hasil_dan_pembahasan' => $validated['hasil_dan_pembahasan'],
            'kesimpulan_dan_saran' => $validated['kesimpulan_dan_saran'],
            'penggunaan_bahasa_dan_tata_tulis' => $validated['penggunaan_bahasa_dan_tata_tulis'],
            'kesesuaian_fungsionalitas_sistem' => $validated['kesesuaian_fungsionalitas_sistem'],
            'revisi' => $validated['revisi'],
            'total_nilai' => $validated['total_nilai'],


        ]);

        $nilaita->save();

        return redirect()->route('admin.nilai_ta.index')->with('success', 'Nilai TA berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nilaita = nilai_ta::findOrFail($id);
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::all();

        return view('admin.nilai_ta.edit', compact('nilaita', 'dosens', 'pengajuans'));
    }
    public function update(Request $request, $id)
    {
        $nilaita = nilai_ta::findOrFail($id);

        $validatedData = $request->validate([
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'jabatan_sidang' => 'required|string|max:50',
            'sikap_dan_penampilan' => 'required|integer|min:0|max:100',
            'komunikasi_dan_sistematika' => 'required|integer|min:0|max:100',
            'penguasaan_materi' => 'required|integer|min:0|max:100',
            'identifikasi_masalah_tujuan_dan_kontribusi_penelitian' => 'required|integer|min:0|max:100',
            'relevansi_teori' => 'required|integer|min:0|max:100',
            'metode_yang_digunakan' => 'required|integer|min:0|max:100',
            'hasil_dan_pembahasan' => 'required|integer|min:0|max:100',
            'kesimpulan_dan_saran' => 'required|integer|min:0|max:100',
            'penggunaan_bahasa_dan_tata_tulis' => 'required|integer|min:0|max:100',
            'kesesuaian_fungsionalitas_sistem' => 'required|integer|min:0|max:100',
            'revisi' => 'required|string|max:255',
            'total_nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilaita->update($validatedData);

        return redirect()
            ->route('admin.nilai_ta.index')
            ->with('success', 'Nilai TA berhasil diupdate.');
    }

    public function destroy($id)
    {
        $nilaita = nilai_ta::find($id);
        $nilaita->delete();
        return redirect()->route('admin.nilai_ta.index')->with('success', 'Nilai TA berhasil dihapus.');
    }
}

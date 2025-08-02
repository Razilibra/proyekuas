<?php

namespace App\Http\Controllers;

use App\Models\PenilaianSidang;
use App\Models\MahasiswaPkl;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PenilaianSidangController extends Controller
{
    public function index()
    {
        $penilaian_sidang = PenilaianSidang::with(['mahasiswaPkl', 'dosen'])->get();
        return view('admin.penilaian_sidang.index', compact('penilaian_sidang'));
    }

    public function create()
    {
        $mahasiswaPkl = MahasiswaPkl::all();
        $dosen = Dosen::all();
        return view('admin.penilaian_sidang.create', compact('mahasiswaPkl', 'dosen'));
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'posisi' => 'required|in:dosen pembimbing,dosen penguji',
            'bahasa' => 'required|integer|min:1|max:100',
            'analisis' => 'required|integer|min:1|max:100',
            'sikap' => 'required|integer|min:1|max:100',
            'komunikasi' => 'required|integer|min:1|max:100',
            'penyajian' => 'required|integer|min:1|max:100',
            'penguasaan' => 'required|integer|min:1|max:100',
            'total_nilai' => 'required|numeric|min:0|max:100',
        ]);

        // Calculate the total value if needed
        // You can remove the following if using front-end calculation, just for backup.
        $totalNilai = $request->bahasa * 0.15 +
                      $request->analisis * 0.15 +
                      $request->sikap * 0.15 +
                      $request->komunikasi * 0.15 +
                      $request->penyajian * 0.15 +
                      $request->penguasaan * 0.25;

        // Store the Penilaian Sidang data
        PenilaianSidang::create([
            'id_mahasiswa_pkl' => $request->id_mahasiswa_pkl,
            'id_dosen' => $request->id_dosen,
            'posisi' => $request->posisi,
            'bahasa' => $request->bahasa,
            'analisis' => $request->analisis,
            'sikap' => $request->sikap,
            'komunikasi' => $request->komunikasi,
            'penyajian' => $request->penyajian,
            'penguasaan' => $request->penguasaan,
            'total_nilai' => $totalNilai
        ]);

        // Redirect back to the previous page with a success message
        return redirect()->route('penilaian_sidang.index')->with('success', 'Penilaian Sidang berhasil ditambahkan!');
    }


    public function show(PenilaianSidang $penilaianSidang)
    {
        return view('admin.penilaian_sidang.show', compact('penilaianSidang'));
    }

    public function edit(PenilaianSidang $penilaianSidang)
    {
        $mahasiswaPkl = MahasiswaPkl::all();
        $dosen = Dosen::all();
        return view('admin.penilaian_sidang.edit', compact('penilaianSidang', 'mahasiswaPkl', 'dosen'));
    }

    public function update(Request $request, PenilaianSidang $penilaianSidang)
    {
        $request->validate([
            'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'bahasa' => 'required|numeric|min:1|max:100',
            'analisis' => 'required|numeric|min:1|max:100',
            'sikap' => 'required|numeric|min:1|max:100',
            'komunikasi' => 'required|numeric|min:1|max:100',
            'penyajian' => 'required|numeric|min:1|max:100',
            'penguasaan' => 'required|numeric|min:1|max:100',
        ]);

        // Bobot setiap aspek penilaian
        $bobot = 15;

        // Menghitung total nilai berdasarkan bobot
        $total_nilai = ($request->bahasa * $bobot) +
                       ($request->analisis * $bobot) +
                       ($request->sikap * $bobot) +
                       ($request->komunikasi * $bobot) +
                       ($request->penyajian * $bobot) +
                       ($request->penguasaan * $bobot);

        // Mengupdate data penilaian sidang dengan total nilai yang dihitung
        $penilaianSidang->update([
            'id_mahasiswa_pkl' => $request->id_mahasiswa_pkl,
            'id_dosen' => $request->id_dosen,
            'bahasa' => $request->bahasa,
            'analisis' => $request->analisis,
            'sikap' => $request->sikap,
            'komunikasi' => $request->komunikasi,
            'penyajian' => $request->penyajian,
            'penguasaan' => $request->penguasaan,
            'total_nilai' => $total_nilai,
        ]);

        return redirect()->route('penilaian_sidang.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(PenilaianSidang $penilaianSidang)
    {
        $penilaianSidang->delete();
        return redirect()->route('penilaian_sidang.index')->with('success', 'Data berhasil dihapus.');
    }
}

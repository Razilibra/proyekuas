<?php

namespace App\Http\Controllers;

use App\Models\Mhs;
use App\Models\sesi;
use App\Models\Dosen;
use App\Models\bidang;
use App\Models\sempro;
use App\Models\ruangan;
use App\Models\pengajuan;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SemproController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $sempro = sempro::query();
        if ($user->level->level === 'Dosen') {
            $sempro->whereHas('pengajuan', function ($query) use ($user) {
                $query->where('pembimbing_1', $user->dosen->id_dosen)
                    ->orWhere('pembimbing_2', $user->dosen->id_dosen)
                    ->orWhere('penguji_sempro', $user->dosen->id_dosen);
            });
        } elseif ($user->level->level === 'Mahasiswa') {
            $sempro->whereHas('pengajuan', function ($query) use ($user) {
                $query->where('id_mahasiswa', $user->mahasiswa->id_mahasiswa);
            });
        } elseif ($user->level->level === 'Kaprodi') {
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        $sempro = $sempro->with(['pengajuan.pembimbing1', 'pengajuan.pembimbing2', 'pengajuan.mahasiswa'])->get();
        if ($sempro->isEmpty()) {
            abort(404);
        }
       /* $sempro = sempro::all(); */

        return view('sempro.index', compact('sempro'));
    }


    public function create()
    {
        $user = Auth::user();
        $mahasiswas = $user->mahasiswa;
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::where('id_mahasiswa', $mahasiswas->id_mahasiswa)->get();
        $ruangans = Ruangan::all();
        return view('sempro.create', compact('pengajuans', 'mahasiswas', 'dosens', 'ruangans'));
    }

    public function getJudul($id_mahasiswa)
    {
        $pengajuans = Pengajuan::where('id_mahasiswa', $id_mahasiswa)->get();
        return response()->json($pengajuans);
    }



    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mhs,id_mahasiswa',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'file_sempro' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
        ]);
        $Sempro = new sempro();
        $Sempro->fill($validated);
        if ($request->filled('id_tugasakhir')) {
            $Sempro->id_tugasakhir = $request->input('id_tugasakhir');
        }

        $documents = [
            'file_sempro' => 'file_sempro',
        ];
        foreach ($documents as $inputName => $documentType) {
            if ($request->hasFile($inputName)) {
                $filename = $request->file($inputName)->getClientOriginalName();
                $path = $request->file($inputName)->storeAs("public/{$documentType}", $filename);
                $Sempro->$inputName = str_replace('public/', '', $path);
            }
        }

        $Sempro->save();

        return redirect()->route('sempro.index')->with('success', 'Sempro berhasil ditambahkan.');
    }

    public function show(sempro $sempro)
    {
        return view('sempro.show', compact('sempro'));
    }

    public function edit(Sempro $sempro)
    {
        $user = Auth::user();
        $mahasiswas = $user->mahasiswa;
        $pengajuans = Pengajuan::where('id_mahasiswa', $mahasiswas->id_mahasiswa)->get();

        return view('sempro.edit', compact('sempro', 'mahasiswas', 'pengajuans'));
    }

    public function update(Request $request, Sempro $sempro)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mhs,id_mahasiswa',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'file_sempro' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
        ]);

        $sempro->id_mahasiswa = $request->id_mahasiswa;
        $sempro->id_pengajuan = $request->id_pengajuan;

        if ($request->hasFile('file_sempro')) {
            if ($sempro->file_sempro) {
                Storage::disk('public')->delete($sempro->file_sempro);
            }

            $filePath = $request->file('file_sempro')->store('file_sempro', 'public');
            $sempro->file_sempro = $filePath;
        }

        $sempro->save();
        return redirect()->route('sempro.index')->with('success', 'Data Sempro berhasil diperbarui.');
    }
    public function jadwal(Sempro $sempro, $id)
    {
        $sempro = Sempro::find($id);
        $dosens = Dosen::all();
        $ruangans = Ruangan::all();
        $sesi = sesi::all();

        return view('sempro.jadwal', compact('sesi', 'sempro', 'dosens', 'ruangans'));
    }

    public function tentukanjadwal(Request $request, $id)
    {
        $request->validate([
            'penguji_sempro' => 'required|exists:dosens,id_dosen',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_sesi' => 'required|exists:sesis,id_sesi',
            'tgl_seminar' => 'required|date',
        ]);

        $existingSchedule = Sempro::where('id_ruangan', $request->id_ruangan)
            ->where('tgl_seminar', $request->tgl_seminar)
            ->where('id_sesi', $request->id_sesi)
            ->first();

        if ($existingSchedule) {
            return redirect()->route('sempro.index')->with('error', 'Ruangan sudah digunakan pada tanggal dan sesi yang dipilih.');
        }

        $sempro = Sempro::find($id);
        if ($sempro) {
            $sempro->penguji_sempro = $request->penguji_sempro;
            $sempro->id_ruangan = $request->id_ruangan;
            $sempro->id_sesi = $request->id_sesi;
            $sempro->tgl_seminar = $request->tgl_seminar;
            $sempro->save();

            return redirect()->route('sempro.index')->with('success', 'Penjadwalan berhasil ditentukan!');
        }

        return redirect()->route('sempro.index')->with('error', 'Data seminar proposal tidak ditemukan!');
    }

    public function destroy(sempro $sempro)
    {
        $sempro->delete();
        return redirect()->route('sempro.index')->with('success', 'Tugas Akhir berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\mhs;
use App\Models\sesi;
use App\Models\Dosen;
use App\Models\bidang;
use App\Models\ruangan;
use App\Models\pengajuan;
use App\Models\sidang_ta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SidangTaController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $sidangta = Sidang_ta::query();

    if ($user->level->level === 'Dosen') {
        if ($user->dosen) {
            $sidangta->whereHas('pengajuan', function ($query) use ($user) {
                $query->where('pembimbing_1', $user->dosen->id_dosen)
                      ->orWhere('pembimbing_2', $user->dosen->id_dosen)
                      ->orWhere('sekretaris', $user->dosen->id_dosen)
                      ->orWhere('anggota_1', $user->dosen->id_dosen)
                      ->orWhere('anggota_2', $user->dosen->id_dosen);
            });
        } else {
            abort(403, 'Anda tidak memiliki data dosen yang valid.');
        }
    } elseif ($user->level->level === 'Mahasiswa') {
        if (!$user->mahasiswa || $user->mahasiswa->status !== 'Disetujui') {
            return redirect()->back()->with('error', 'Status Bimbingan Anda belum disetujui.');
        }

        $sidangta->whereHas('pengajuan', function ($query) use ($user) {
            $query->where('id_mhs', $user->mahasiswa->id_mahasiswa);
        });
    } elseif ($user->level->level === 'Kaprodi') {
        // Handle logic for Kaprodi here
    } else {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    $sidangta = $sidangta->with(['pengajuan.pembimbing1', 'pengajuan.pembimbing2', 'pengajuan.mahasiswa'])->get();

    // Kembalikan data ke view
    return view('admin.sidang_ta.index', compact('sidangta', 'user'));
}

    public function create()
    {
        $user = Auth::user();
        $mahasiswas = $user->mahasiswa;
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::where('id_mhs', $mahasiswas->id_mahasiswa)->get();

        return view('admin.sidang_ta.create', compact('pengajuans', 'mahasiswas', 'dosens'));
    }

    public function getJudul($id_mhs)
    {
        $pengajuans = Pengajuan::where('id_mhs', $id_mhs)->get();
        return response()->json($pengajuans);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'id_mhs' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'full_ta' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'bab_1' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'poster' => 'nullable|file|mimes:jpg,jpeg,pdf,doc,docx|max:7060',

        ]);
        $sidangta = new sidang_ta();
        $sidangta->fill($validated);
        if ($request->filled('id_sidang')) {
            $sidangta->id_sidang = $request->input('id_sidang');
        }

        $documents = [
            'full_ta' => 'full_ta',
            'bab_1' => 'bab_1',
            'poster' => 'poster',
        ];
        foreach ($documents as $inputName => $documentType) {
            if ($request->hasFile($inputName)) {
                $filename = $request->file($inputName)->getClientOriginalName();
                $path = $request->file($inputName)->storeAs("public/{$documentType}", $filename);
                $sidangta->$inputName = str_replace('public/', '', $path);
            }
        }

        $sidangta->save();

        return redirect()->route('admin.sidang_ta.index')->with('success', 'Sidang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $sidangta = sidang_ta::find($id);
        return view('admin.sidang_ta.show', compact('sidangta'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $mahasiswas = $user->mahasiswa;
        $dosens = Dosen::all();
        $pengajuans = Pengajuan::where('id_mhs', $mahasiswas->id_mhs)->get();
        $sidangta = sidang_ta::find($id);
        $dosens = Dosen::all();

        return view('admin.sidang_ta.edit', compact('sidangta', 'mahasiswas', 'dosens', 'pengajuans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_mhs' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_pengajuan' => 'required|exists:pengajuans,id_tugasakhir',
            'full_ta' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'bab_1' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'poster' => 'nullable|file|mimes:jpg,jpeg,pdf,doc,docx|max:7060',
        ]);

        $sidangta = sidang_ta::findOrFail($id);
        $sidangta->fill($validated);
        $documents = [
            'full_ta' => 'full_ta',
            'bab_1' => 'bab_1',
            'poster' => 'poster',
        ];

        foreach ($documents as $inputName => $documentType) {
            if ($request->hasFile($inputName)) {
                if ($sidangta->$inputName) {
                    Storage::delete("public/{$sidangta->$inputName}");
                }
                $file = $request->file($inputName);
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs("public/{$documentType}", $filename);
                $sidangta->$inputName = str_replace('public/', '', $path);
            }
        }

        $sidangta->save();
        return redirect()->route('admin.sidang_ta.index')->with('success', 'Sidang berhasil diperbarui.');
    }


    public function jadwal(sidang_ta $sidangta, $id)
    {
        $sidangta = sidang_ta::find($id);
        $dosens = Dosen::all();
        $ruangans = Ruangan::all();
        $sesi = sesi::all();

        return view('admin.sidang_ta.jadwal', compact('sesi', 'sidangta', 'dosens', 'ruangans'));
    }

    public function tentukanjadwal(Request $request, $id)
    {
        $request->validate([
            'sekretaris' => 'required|exists:dosens,id_dosen',
            'anggota_1' => 'required|exists:dosens,id_dosen',
            'anggota_2' => 'required|exists:dosens,id_dosen',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_sesi' => 'required|exists:sesis,id_sesi',
            'tgl_sidang' => 'required|date',
        ]);
        $penguji = [$request->sekretaris, $request->anggota_1, $request->anggota_2];
        if (count($penguji) !== count(array_unique($penguji))) {
            return redirect()->route('admin.sidang_ta.index')->with('error', 'Para penguji tidak boleh sama!');
        }

        $existingSchedule = sidang_ta::where('id_ruangan', $request->id_ruangan)
            ->where('tgl_sidang', $request->tgl_sidang)
            ->where('id_sesi', $request->id_sesi)
            ->first();

        if ($existingSchedule) {
            return redirect()->route('admin.sidang_ta.index')->with('error', 'Ruangan sudah digunakan pada tanggal dan sesi yang dipilih.');
        }
        $sidangta = sidang_ta::find($id);
        if ($sidangta) {
            $sidangta->sekretaris = $request->sekretaris;
            $sidangta->anggota_1 = $request->anggota_1;
            $sidangta->anggota_2 = $request->anggota_2;
            $sidangta->id_ruangan = $request->id_ruangan;
            $sidangta->id_sesi = $request->id_sesi;
            $sidangta->tgl_sidang = $request->tgl_sidang;
            $sidangta->save();

            return redirect()->route('admin.sidang_ta.index')->with('success', 'Penjadwalan berhasil ditentukan!');
        }

        return redirect()->route('admin.sidang_ta.index')->with('error', 'Data sidang tidak ditemukan!');
    }


    public function destroy($id)
    {
        $sidangta = sidang_ta::find($id);

        if (!$sidangta) {
            return redirect()->route('admin.sidang_ta.index')->with('error', 'Sidang tidak ditemukan.');
        }
        $sidangta->delete();
        return redirect()->route('admin.sidang_ta.index')->with('success', 'Sidang berhasil dihapus.');
    }

}

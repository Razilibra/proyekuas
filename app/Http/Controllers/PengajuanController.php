<?php

namespace App\Http\Controllers;

use App\Models\bidang;
use App\Models\bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PengajuanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengajuans = Pengajuan::query();
        if ($user->level->level === 'Dosen') {
            $pengajuans->where(function ($query) use ($user) {
                $query->where('pembimbing_1', $user->dosen->id_dosen)
                    ->orWhere('pembimbing_2', $user->dosen->id_dosen);
            });
        } elseif ($user->level->level === 'Mahasiswa') {
            $pengajuans->where('mahasiswa_id', $user->mahasiswa->id_mahasiswa);
        } elseif ($user->level->level !== 'Kaprodi') {
        }
        $pengajuans = $pengajuans->get();

        return view('admin.pengajuan.index', compact('pengajuans', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        if (! $user || $user->level->level !== 'Mahasiswa') {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
        $mahasiswalogin = $user->name;
        $mahasiswa = Mahasiswa::where('nama', 'like', '%'.$mahasiswalogin.'%')->first();
        if (! $mahasiswa) {
            throw new NotFoundHttpException('Mahasiswa tidak ditemukan.');
        }
        $datamahasiswa = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('admin.pengajuan.create', compact('mahasiswa', 'dosens', 'mahasiswalogin', 'datamahasiswa'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:500',
            'mahasiswa_id' => 'required|exists:mahasiswa,id_mahasiswa',
            'bidang_id' => 'nullable|exists:bidangs,id_bidang',
            'pembimbing_1' => 'nullable|exists:dosens,id_dosen',
            'pembimbing_2' => 'nullable|exists:dosens,id_dosen',
            'ipk' => 'required|numeric|between:0,4.00',
            'proposal_tugas_akhir' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'nullable|string|',
            'acc_pembimbing1' => 'nullable|string|max:500',
            'acc_pembimbing2' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        if ($request->hasFile('proposal_tugas_akhir')) {
            $filePath = $request->file('proposal_tugas_akhir')->storeAs(
                'proposal_tugas_akhir',
                time().'_'.$request->file('proposal_tugas_akhir')->getClientOriginalName(),
                'public'
            );
            $data['proposal_tugas_akhir'] = $filePath;
        }

        // Set status default jika tidak ada
        if (empty($data['status'])) {
            $data['status'] = 'Usulan';
        }

        // Buat pengajuan baru
        Pengajuan::create($data);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dibuat.');
    }

    public function showTentukanPembimbingForm($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $dosens = Dosen::all();  // Or use any logic to fetch the dosens
        $bidangs = Bidang::all();  // Or use any logic to fetch the bidangs
        return view('admin.pengajuan.pembimbing', compact('pengajuan', 'dosens','bidangs'));
    }

     public function getDosen($id_bidang)
     {
         $dosens = Dosen::where('id_bidang', $id_bidang)->get(['id_dosen', 'nama']);
         return response()->json($dosens);
     }

    private function checkPembimbingKuota($id)
    {
        return pengajuan::where('pembimbing_1', $id)
            ->orWhere('pembimbing_2', $id)
            ->count();
    }

    public function tentukanPembimbing(Request $request, $id)
    {
        $validated = $request->validate([
            'pembimbing_1' => 'nullable|exists:dosens,id_dosen',
            'pembimbing_2' => 'nullable|exists:dosens,id_dosen',
            'status' => 'nullable|string|',
        ]);

        $pengajuan = pengajuan::findOrFail($id);
        if ($validated['pembimbing_1'] === $validated['pembimbing_2']) {
            return redirect()->back()
                ->withErrors(['pembimbing_2' => 'Pembimbing 1 dan Pembimbing 2 tidak boleh sama.'])
                ->withInput();
        }

        $mahasiswaCount1 = pengajuan::where('pembimbing_1', $validated['pembimbing_1'])->count();
        if ($mahasiswaCount1 >= 4) {
            return redirect()->back()
                ->withErrors(['pembimbing_1' => 'Dosen ini sudah membimbing 4 mahasiswa.'])
                ->withInput();
        }

        $mahasiswaCount2 = pengajuan::where('pembimbing_2', $validated['pembimbing_2'])->count();
        if ($mahasiswaCount2 >= 4) {
            return redirect()->back()
                ->withErrors(['pembimbing_2' => 'Dosen ini sudah membimbing 4 mahasiswa.'])
                ->withInput();
        }
        $pengajuan->pembimbing_1 = $validated['pembimbing_1'];
        $pengajuan->pembimbing_2 = $validated['pembimbing_2'];

        if (in_array($validated['status'], ['Usulan', 'Proses', 'Terima', 'Perbaikan', 'Tolak'])) {
            $pengajuan->status = $validated['status'];
        } else {
            return redirect()->back()
                ->withErrors(['status' => 'Invalid status value.']);
        }
        $pengajuan->save();

        return redirect()->route('pengajuan.index', $id)
            ->with('success', 'Pembimbing telah ditentukan!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (! $user || $user->level->level !== 'mahasiswa') {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
        $mahasiswalogin = $user->name;
        $mahasiswas = Mahasiswa::where('nama', 'like', '%'.$mahasiswalogin.'%')->first();
        if (! $mahasiswas) {
            throw new NotFoundHttpException('Mahasiswa tidak ditemukan.');
        }
        $datamahasiswa = Mahasiswa::all();
        $pengajuan = Pengajuan::findOrFail($id);
        $dosens = Dosen::all();

        return view('pengajuan.pengajuanedit', compact('pengajuan', 'mahasiswas', 'dosens', 'mahasiswalogin', 'datamahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:500',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'pembimbing_1' => 'nullable|exists:dosens,id',
            'pembimbing_2' => 'nullable|exists:dosens,id',
            'ipk' => 'required|string',
            'proposal_tugas_akhir' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'acc_pembimbing1' => 'nullable|string|max:500',
            'acc_pembimbing2' => 'nullable|string|max:500',
            'status' => 'nullable|string|in:Usulan,Pengajuan_kembali,Revisi',
        ]);
        $status = $request->has('status') ? $request->status : 'Pengajuan_kembali';
        $pengajuan = Pengajuan::findOrFail($id);
        if ($request->hasFile('proposal_tugas_akhir')) {
            if ($pengajuan->dokumen) {
                Storage::disk('public')->delete($pengajuan->dokumen);
            }
            $filePath = $request->file('proposal_tugas_akhir')->store('proposal_tugas_akhir', 'public');
            $request->merge(['proposal_tugas_akhir' => $filePath]);
        }
        $pengajuan->status = $status;
        $pengajuan->update($request->all());

        return redirect()->route('pengajuan.')->with('success', 'Pengajuan updated successfully');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    public function accPembimbing1($id)
    {
        $pengajuan = Pengajuan::find($id);
        if ($pengajuan) {
            $pengajuan->acc_pembimbing1 = 'Disetujui'; // Atur status pembimbing 1 menjadi 'Disetujui'
            $pengajuan->save();

            return redirect()->back()->with('success', 'Pembimbing 1 berhasil disetujui.');
        }

        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }

    public function accPembimbing2($id)
    {
        $pengajuan = Pengajuan::find($id);
        if ($pengajuan) {
            $pengajuan->acc_pembimbing2 = 'Disetujui'; // Atur status pembimbing 2 menjadi 'Disetujui'
            $pengajuan->save();

            return redirect()->back()->with('success', 'Pembimbing 2 berhasil disetujui.');
        }

        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }

    public function accProdi($id)
    {
        $pengajuan = Pengajuan::find($id);

        if ($pengajuan) {
            if ($pengajuan->acc_pembimbing1 == 'Disetujui' && $pengajuan->acc_pembimbing2 == 'Disetujui') {
                $pengajuan->status = 'Disetujui';
                $pengajuan->save();

                $bimbingan = new bimbingan;
                $bimbingan->mahasiswa_id = $pengajuan->mahasiswa_id;
                $bimbingan->dosen_id = $pengajuan->dosen_id;
                $bimbingan->pengajuan_id = $pengajuan->pengajuan_id;
                $bimbingan->status = 'Aktif';
                $bimbingan->save();

                return redirect()->back()->with('success', 'Pengajuan telah disetujui oleh Prodi dan bimbingan telah dibuat.');
            } else {
                return redirect()->back()->with('error', 'Pengajuan belum disetujui oleh kedua pembimbing.');
            }
        }

        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if ($pengajuan->dokumen) {
            Storage::disk('public')->delete($pengajuan->dokumen);
        }
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan deleted successfully.');
    }
}

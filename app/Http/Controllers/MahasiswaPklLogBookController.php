<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MahasiswaPkl;
use Illuminate\Http\Request;
use App\Models\RegistrasiPkl;
use App\Models\MahasiswaPklLogBook;
use Illuminate\Support\Facades\Storage;

class MahasiswaPklLogBookController extends Controller
{
    public function index()
    {
        $mahasiswa_log_book_pkl = MahasiswaPklLogBook::all();  // Fetching the log book entries

        return view('admin.logbookpkl.index', compact('mahasiswa_log_book_pkl'));
    }


    public function create()
    {
        $registrasi_pkl = Registrasipkl::all();
        $mahasiswa = Mahasiswa::all();
        return view('admin.logbookpkl.create', compact('registrasi_pkl','mahasiswa'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_registrasi_pkl' => 'required|exists:registrasi_pkl,id_registrasi_pkl',
            'tanggal_kegiatan_awal' => 'required|date',
            'tanggal_kegiatan_akhir' => 'required|date',
            'kegiatan' => 'required',
            'file_dokumentasi' => 'nullable|file|max:2048',
            'komentar' => 'nullable',
            'validasi' => 'nullable|in:0,1',
        ]);

        if ($request->hasFile('file_dokumentasi')) {
            $path = $request->file('file_dokumentasi')->store('dokumentasi', 'public');
            $validatedData['file_dokumentasi'] = $path;
        }

        MahasiswaPklLogBook::create($validatedData);

        return redirect()->route('mahasiswapkllogbook.index')
            ->with('success', 'Data logbook berhasil ditambahkan');
    }

    public function show(MahasiswaPklLogBook $mahasiswapkllogbook)
    {
        return view('admin.logbookpkl.show', ['logbook' => $mahasiswapkllogbook]);
    }

    public function edit(MahasiswaPklLogBook $mahasiswapkllogbook)
    {
        return view('admin.logbookpkl.edit', ['logbook' => $mahasiswapkllogbook]);
    }

    public function update(Request $request, MahasiswaPklLogBook $mahasiswapkllogbook)
    {
        $validatedData = $request->validate([
            'id_registrasi_pkl' => 'required|exists:registrasi_pkl,id_registrasi_pkl',
            'tanggal_kegiatan_awal' => 'required|date',
            'tanggal_kegiatan_akhir' => 'required|date',
            'kegiatan' => 'required',
            'file_dokumentasi' => 'nullable|file|max:2048',
            'komentar' => 'nullable',
            'validasi' => 'required|boolean'
        ]);

        if ($request->hasFile('file_dokumentasi')) {
            if ($mahasiswapkllogbook->file_dokumentasi) {
                Storage::disk('public')->delete($mahasiswapkllogbook->file_dokumentasi);
            }
            $path = $request->file('file_dokumentasi')->store('dokumentasi', 'public');
            $validatedData['file_dokumentasi'] = $path;
        }

        $mahasiswapkllogbook->update($validatedData);

        return redirect()->route('mahasiswapkllogbook.index')
            ->with('success', 'Data logbook berhasil diperbarui');
    }

    public function destroy(MahasiswaPklLogBook $mahasiswapkllogbook)
    {
        if ($mahasiswapkllogbook->file_dokumentasi) {
            Storage::disk('public')->delete($mahasiswapkllogbook->file_dokumentasi);
        }

        $mahasiswapkllogbook->delete();

        return redirect()->route('mahasiswapkllogbook.index')
            ->with('success', 'Data logbook berhasil dihapus');
    }

    public function validasi(Request $request, MahasiswaPklLogBook $logbook)
    {
        $validatedData = $request->validate([
            'validasi' => 'required|boolean',
            'komentar' => 'nullable|string'
        ]);

        $logbook->update($validatedData);

        return redirect()->back()->with('success', 'Status validasi berhasil diperbarui');
    }
    public function acc($id)
    {
        $logbook = MahasiswaPklLogBook::findOrFail($id);

        // Mengubah kolom 'validasi' menjadi '1' (ACC)
        $logbook->update(['validasi' => '1']);

        return redirect()->route('mahasiswapkllogbook.index')->with('success', 'Logbook berhasil di-ACC!');
    }

    public function revoke($id)
    {
        $logbook = MahasiswaPklLogBook::findOrFail($id);

        // Membatalkan validasi (ubah menjadi '0')
        $logbook->update(['validasi' => '0']);

        return redirect()->route('mahasiswapkllogbook.index')->with('success', 'Validasi logbook dibatalkan!');
    }

}

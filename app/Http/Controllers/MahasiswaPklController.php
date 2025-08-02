<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\TempatPkl;
use App\Models\MahasiswaPkl;
use App\Models\PenilaianSidang;
use App\Models\RegistrasiPkl;
use Illuminate\Http\Request;

class MahasiswaPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa_pkl = MahasiswaPkl::with(['mahasiswa', 'tempatPkl'])->get();
        return view('admin.mahasiswapkl.index', compact('mahasiswa_pkl'));
    }

   // Show the penilaian form for the given mahasiswa PKL
// public function penilaian($id)
// {
//     $mahasiswaPkl = MahasiswaPkl::findOrFail($id);

//     return view('admin.mahasiswapkl.penilaian', compact('mahasiswaPkl'));
// }

// public function simpanPenilaian(Request $request, $id)
// {
//     // Validasi input
//     $validated = $request->validate([
//         'nilai_pembimbing_industri' => 'required|numeric|min:0|max:100',
//         'rekomendasi' => 'required|string',
//         'informasi_detail' => 'nullable|string',
//     ]);

//     $mahasiswaPkl = MahasiswaPkl::findOrFail($id);

//     $mahasiswaPkl->nilai_pembimbing_industri = $validated['nilai_pembimbing_industri'];
//     $mahasiswaPkl->rekomendasi = $validated['rekomendasi'];
//     $mahasiswaPkl->informasi_detail = $validated['informasi_detail'];

//     $mahasiswaPkl->save();

//     // Redirect dengan pesan sukses
//     return redirect()->route('mahasiswapkl.index')->with('success', 'Penilaian berhasil disimpan.');
// }





    // public function tentukanPembimbing($id)
    // {
    //     $mahasiswaPkl = MahasiswaPKL::findOrFail($id);
    //     $dosen = Dosen::all();

    //     return view('admin.mahasiswapkl.pembimbing', compact('mahasiswaPkl', 'dosen'));
    // }

    // public function storePembimbing(Request $request)
    // {
    //     $request->validate([
    //         'dosen_pembimbing' => 'required|exists:dosens,id_dosen', // Pastikan 'dosens' sesuai nama tabel
    //      //   'pembimbing_pkl' => 'required|string|max:255',
    //         'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl', // Validasi ID mahasiswa PKL
    //     ]);

    //     // Pastikan data mahasiswa PKL ditemukan
    //     $mahasiswaPkl = MahasiswaPKL::findOrFail($request->id_mahasiswa_pkl);

    //     // Update data
    //     $mahasiswaPkl->update([
    //         'dosen_pembimbing' => $request->dosen_pembimbing,
    //         'pembimbing_pkl' => $request->pembimbing_pkl,
    //     ]);

    //     return redirect()->route('mahasiswapkl.index')
    //         ->with('success', 'Pembimbing PKL berhasil disimpan.');
    // }

    public function jadwal($id)
    {

        // Ambil data dosen untuk dropdown
        $dosen = Dosen::all();
        $sesi=sesi::all();
        // Ambil data mahasiswa PKL berdasarkan ID
        $mahasiswaPkl = MahasiswaPkl::findOrFail($id);

        // Kirim data ke view
        return view('admin.mahasiswapkl.jadwal', compact('dosen', 'mahasiswaPkl','sesi'));
    }




    public function jadwalSidang()
    {

        // Return the view for creating a new jadwal sidang
        $sesi = Sesi::all();
        $dosen = Dosen::all();
        return view('admin.mahasiswapkl.jadwal', compact('dosen','sesi'));
    }

    public function storeJadwal(Request $request)
    {


        // Validasi input
        $request->validate([
            'id_mahasiswa_pkl' => 'required|exists:mahasiswa_pkl,id_mahasiswa_pkl',
            'id_sesi' => 'required|exists:sesi,id_sesi',
            'dosen_penguji' => 'required|exists:dosens,id_dosen',
            'ruangan_sidang' => 'required|string|max:255',
            'tanggal_sidang' => 'required|date',
        ]);

        // Mencari mahasiswa_pkl berdasarkan id yang ada di request
        $mahasiswaPkl = MahasiswaPkl::find($request->id_mahasiswa_pkl);

        // Pastikan data ditemukan
        if (!$mahasiswaPkl) {
            return redirect()->back()->with('error', 'Data Mahasiswa PKL tidak ditemukan.');
        }

        // Update data dengan data yang diterima dari request
        $mahasiswaPkl->id_sesi = $request->id_sesi;
        $mahasiswaPkl->dosen_penguji = $request->dosen_penguji;
        $mahasiswaPkl->ruangan_sidang = $request->ruangan_sidang;
        $mahasiswaPkl->tanggal_sidang = $request->tanggal_sidang;

        // Menyimpan perubahan
        $mahasiswaPkl->save();

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswapkl.index')->with('success', 'Jadwal sidang berhasil ditambahkan!');
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sesi = Sesi::all();
        $dosen = Dosen::all();
        $jadwal_sidang = MahasiswaPkl::all();
        $prodi = Prodi::all();
        $jurusan = Jurusan::all();
        $mahasiswa = Mahasiswa::all();
        // $registrasi_pkl = RegistrasiPkl::all();
        $registrasi_pkl = RegistrasiPkl::all();
        /*$tempat_pkl = TempatPkl::all(); */
        return view('admin.mahasiswapkl.create', compact('dosen', 'jadwal_sidang', 'prodi', 'jurusan', 'mahasiswa', 'sesi','registrasi_pkl'));
    }

    /**
     *
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            /* 'id_tempat_pkl' => 'nullable|exists:tempat_pkl,id_tempat_pkl', */
            'id_registrasi_pkl' => 'required|exists:registrasi_pkl,id_registrasi_pkl',
            'judul' => 'required|string|max:255',
            'tahun_pkl' => 'required|date',
            'pembimbing_pkl' => 'required|string|max:255',
            'nilai_pembimbing_industri' => 'required|numeric|min:0|max:100',
            'rekomendasi' => 'required|string|max:255',
            'informasi_detail' => 'nullable|string|max:1000',
            'dokument_nilai_industri' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'dokument_pkl' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'dokument_pkl_revisi' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'dokument_kuisioner' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $validated;

        // Proses upload file
        $fileFields = ['dokument_nilai_industri', 'dokument_pkl', 'dokument_pkl_revisi', 'dokument_kuisioner'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/dokumen-pkl', $filename);
                $data[$field] = str_replace('public/', '', $path);
            }
        }

        MahasiswaPKL::create($data);

        return redirect()->route('mahasiswapkl.index')
            ->with('success', 'Data Mahasiswa PKL berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MahasiswaPkl $mahasiswaPkl)
    {
        $mahasiswa = Mahasiswa::all();
        $tempat_pkl = TempatPkl::all();
        return view('admin.mahasiswapkl.edit', compact('mahasiswaPkl', 'mahasiswa', 'tempat_pkl'));
    }

    /**
     * Update the specified resource in storage.
     */


     public function show($id)
{
    // Ambil data mahasiswa PKL berdasarkan ID
    $mahasiswaPkl = MahasiswaPkl::with(['registrasi'])->findOrFail($id);

    // Inisialisasi penilaian
    $dosen_pembimbing = null;
    $dosen_penguji = null;

    // Ambil data penilaian jika tersedia
    if ($mahasiswaPkl->registrasiPkl && $mahasiswaPkl->registrasiPkl->penilaianSidang) {
        foreach ($mahasiswaPkl->registrasiPkl->penilaianSidang as $penilaian) {
            if ($penilaian->posisi === 'dosen pembimbing') {
                $dosen_pembimbing = $penilaian;
            } elseif ($penilaian->posisi === 'dosen penguji') {
                $dosen_penguji = $penilaian;
            }
        }
    }

    return view('admin.mahasiswapkl.show', compact('mahasiswaPkl', 'dosen_pembimbing', 'dosen_penguji'));
}

    public function update(Request $request, MahasiswaPkl $mahasiswaPkl)
    {
        $request->validate([
            'id_mahasiswa' => 'nullable|exists:mahasiswa,id_mahasiswa',
            'judul' => 'required|string|max:255',
            'ruangan_sidang' => 'required|string|max:255',
            'id_tempat_pkl' => 'nullable|exists:tempat_pkl,id_tempat_pkl',
            'tahun_pkl' => 'nullable|string|max:50',
            'dosen_pembimbing' => 'nullable|string|max:255',
            'dosen_penguji' => 'nullable|string|max:255',
            'pembimbing_pkl' => 'nullable|string|max:255',
            'nilai_pembimbing_industri' => 'nullable|numeric',
            'dokument_nilai_industri' => 'nullable|string',
            'dokument_pkl' => 'nullable|string',
            'dokument_pkl_revisi' => 'nullable|string',
            'dokument_kuisioner' => 'nullable|string',
            'tanggal_sidang' => 'nullable|date',
            'rekomendasi' => 'nullable|string|max:255',
            'informasi_detail' => 'nullable|string',
        ]);

        $mahasiswaPkl->update($request->all());

        return redirect()->route('mahasiswapkl.index')->with('success', 'Data Mahasiswa PKL berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */






    public function destroy($id)
    {
        $mahasiswaPkl = MahasiswaPkl::findOrFail($id);
        $mahasiswaPkl->delete();

        return redirect()->route('mahasiswapkl.index')->with('success', 'Data Mahasiswa PKL berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UsulanPkl;
use App\Models\Mahasiswa;
use App\Models\TempatPkl;
use Illuminate\Http\Request;

class UsulanPklController extends Controller
{
    /**
     * Menampilkan daftar usulan PKL.
     */
    public function index()
    {
        $usulan_pkl = UsulanPkl::with(['mahasiswa', 'tempatPkl'])->get();
        return view('admin.usulanpkl.index', compact('usulan_pkl'));
    }

    /**
     * Menampilkan form untuk menambahkan usulan PKL baru.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $tempat_pkl = TempatPkl::all();
        return view('admin.usulanpkl.create', compact('mahasiswa', 'tempat_pkl'));
    }

    /**
     * Menyimpan usulan PKL baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_tempat_pkl' => 'required|exists:tempat_pkl,id_tempat_pkl',
            'tahun_ajaran' => 'required|string|max:20',
             'konfirmasi' => 'required|in:0,1',
        ]);



        UsulanPkl::create($request->all());
        return redirect()->route('usulan_pkl.index')->with('success', 'Usulan PKL berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit usulan PKL.
     */
    public function edit($id)
    {
        $usulan_pkl = UsulanPkl::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        $tempat_pkl = TempatPkl::all();
        return view('admin.usulanpkl.edit', compact('usulan_pkl', 'mahasiswa', 'tempat_pkl'));
    }

    /**
     * Memperbarui data usulan PKL di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_tempat_pkl' => 'required|exists:tempat_pkl,id_tempat_pkl',
            'tahun_ajaran' => 'required|string|max:20',
            'konfirmasi' => 'required|in:0,1',
        ]);

        $usulanPkl = UsulanPkl::findOrFail($id);
        $usulanPkl->update($request->all());
        return redirect()->route('usulan_pkl.index')->with('success', 'Usulan PKL berhasil diperbarui.');

        if ($request->status == 0 && $tempatPkl->status != 0) {
            $tempatPkl->kuota += 1;
        }

        // Update data lainnya
        $tempatPkl->nama_perusahaan = $request->nama_perusahaan;
        $tempatPkl->info_pkl = $request->info_pkl;
        $tempatPkl->kuota = $request->kuota;
        $tempatPkl->status = $request->status;
        $tempatPkl->save();

        return redirect()->route('tempat_pkl.index')
            ->with('success', 'Data berhasil diperbarui.');

    }
    public function acc($id)
{
    // Temukan Usulan PKL berdasarkan ID
    $usulan = UsulanPkl::findOrFail($id);

    // Periksa jika usulan sudah diterima sebelumnya
    if ($usulan->konfirmasi == '1') { // Konfirmasi '1' berarti sudah diterima
        return redirect()->route('usulan_pkl.index')->with('error', 'Usulan sudah diterima.');
    }

    // Update status konfirmasi usulan PKL menjadi diterima
    $usulan->konfirmasi = '1'; // Atur konfirmasi menjadi '1'
    $usulan->save();

    // Ambil data tempat PKL yang terkait dengan usulan ini
    $tempatPkl = TempatPkl::findOrFail($usulan->id_tempat_pkl);

    // Kurangi kuota tempat PKL jika kuota masih tersedia
    if ($tempatPkl->kuota > 0) {
        $tempatPkl->kuota -= 1; // Kurangi kuota
        $tempatPkl->save();
    } else {
        return redirect()->route('usulan_pkl.index')->with('error', 'Kuota tempat PKL sudah habis.');
    }

    // Redirect ke halaman utama dengan pesan sukses
    return redirect()->route('usulan_pkl.index')->with('success', 'Usulan PKL telah diterima dan kuota dikurangi.');
}



    /**
     * Menghapus usulan PKL dari database.
     */
    public function destroy($id)
    {
        $usulanPkl = UsulanPkl::findOrFail($id);
        $usulanPkl->delete();
        return redirect()->route('usulan_pkl.index')->with('success', 'Usulan PKL berhasil dihapus.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TempatPkl;
use Illuminate\Http\Request;
use App\Models\RegistrasiPkl;

class RegistrasiPklController extends Controller
{

        public function index()
        {
            $registrasi_pkl = RegistrasiPkl::all();
            $dosen = Dosen::all(); // Semua data dosen
            $tempat_pkl = TempatPkl::all(); // Semua data tempat PKL

            return view('admin.registrasi_pkl.index', compact('registrasi_pkl', 'dosen', 'tempat_pkl'));
        }


    public function Pembimbing($id)
    {
        // Fetch a single instance of registrasi_pkl by ID
        $registrasi_pkl = RegistrasiPkl::findOrFail($id);
        $dosen = Dosen::all();

        return view('admin.registrasi_pkl.pembimbing', compact('registrasi_pkl', 'dosen'));
    }
    public function storePembimbing(Request $request)
{

    // Validate the incoming request data
    $request->validate([
        'id_registrasi_pkl' => 'required|exists:registrasi_pkl,id_registrasi_pkl',  // Ensure valid registrasi PKL
        'pembimbing_id' => 'required|exists:dosens,id_dosen',  // Corrected the field name here
    ]);

    // Find the Registrasi PKL record by ID
    $registrasi_pkl = RegistrasiPkl::find($request->id_registrasi_pkl);

    // Ensure data is found
    if (!$registrasi_pkl) {
        return redirect()->back()->with('error', 'Data Registrasi PKL tidak ditemukan.');
    }

    // Update the registrasi_pkl with the new pembimbing_id
    $registrasi_pkl->pembimbing_id = $request->pembimbing_id;

    // Save the changes
    $registrasi_pkl->save();

    // Redirect with success message
    return redirect()->route('registrasipkl.index')->with('success', 'Pembimbing berhasil ditentukan!');
}



    public function create()
    {


        $tempat_pkl = TempatPkl::all();
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('admin.registrasi_pkl.create',compact('mahasiswa','dosen','tempat_pkl'));
    }

    public function store(Request $request)
    {


        // Validate the incoming data
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa|unique:registrasi_pkl',
            'id_tempat_pkl' => 'required|exists:tempat_pkl,id_tempat_pkl',
            'alamat_perusahaan' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
            //'pembimbing_id' => 'nullable|exists:dosen,id_dosen',
            'konfirmasi' => 'nullable|in:0,1',
        ]);

        // Store the new registrasi_pkl record
        $data = $request->only(['id_mahasiswa','id_tempat_pkl', 'alamat_perusahaan', 'file', 'pembimbing_id', 'konfirmasi']);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $data['file'] = $filePath;
        }

      RegistrasiPkl::create($data);

        return redirect()->route('registrasipkl.index')->with('success', 'Registrasi PKL berhasil ditambahkan.');
    }

    public function show($id)
    {
        $registrasi_pkl = RegistrasiPkl::findOrFail($id);
        return view('admin.registrasi_pkl.show', compact('registrasi_pkl'));
    }

    public function edit($id)
    {
        $dosen = Dosen::all();
        $registrasiPkl = RegistrasiPkl::findOrFail($id);
        return view('admin.registrasi_pkl.edit', compact('registrasiPkl','dosen'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa|unique:registrasi_pkl',
            'id_tempat_pkl' => 'required|exists:tempat_pkl,id_tempat_pkl',
            'alamat_perusahaan' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
           // 'pembimbing_id' => 'nullable|exists:dosen,id_dosen',
            'konfirmasi' => 'nullable|in:0,1',
        ]);

        $registrasiPkl = RegistrasiPkl::findOrFail($id);
        $data = $request->only(['nama_perusahaan', 'alamat_perusahaan', 'file', 'pembimbing_id', 'konfirmasi']);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $data['file'] = $filePath;
        }

        $registrasiPkl->update($data);

        return redirect()->route('registrasi_pkl.index')->with('success', 'Registrasi PKL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the Registrasi PKL record by ID
        $registrasiPkl = RegistrasiPkl::findOrFail($id);

        // Find the associated Tempat PKL based on the id_tempat_pkl
        $tempatPkl = TempatPkl::findOrFail($registrasiPkl->id_tempat_pkl);

        // Increase the kuota of the Tempat PKL by 1
        $tempatPkl->kuota += 1;
        $tempatPkl->save();

        // Delete the Registrasi PKL record
        $registrasiPkl->delete();

        return redirect()->route('registrasipkl.index')->with('success', 'Registrasi PKL berhasil dihapus dan kuota bertambah!');
    }


    public function acc($id)
    {
        // Cari data Registrasi PKL berdasarkan ID
        $registrasiPkl = RegistrasiPkl::findOrFail($id);


        // Cari data Tempat PKL berdasarkan ID yang ada di Registrasi PKL
        $tempatPkl = TempatPkl::findOrFail($registrasiPkl->id_tempat_pkl);

        // Pastikan kuota tempat PKL lebih dari 0 sebelum mengurangi
        if ($tempatPkl->kuota > 0) {
            // Ubah kolom 'konfirmasi' menjadi '1' (ACC)
            $registrasiPkl->update(['konfirmasi' => '1']);

            // Kurangi kuota tempat PKL
            $tempatPkl->kuota -= 1;
            $tempatPkl->save();

            return redirect()->route('registrasipkl.show',$registrasiPkl->id_registrasi_pkl)->with('success', 'Registrasi PKL berhasil di-ACC dan kuota berkurang!');
        } else {
            return redirect()->route('registrasipkl.show',$registrasiPkl->id_registrasi_pkl)->with('error', 'Kuota tempat PKL sudah habis.');
        }
    }

}

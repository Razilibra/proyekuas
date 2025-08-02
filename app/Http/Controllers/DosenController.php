<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Jurusan;
use App\Models\Pangkat;
use App\Models\Golongan;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // Menampilkan semua data dosen
    public function index()
    {
        $dosen = Dosen::all();
        return view('admin.dosen.index', compact('dosen'));
    }

    // Menampilkan form untuk menambahkan dosen baru
    public function create()
    {
        $bidangs = Bidang::all();
        $golongan = Golongan::all();
        $pangkat = Pangkat::all();
        $jabatan = Jabatan::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();

        return view('admin.dosen.create', compact('prodi', 'jurusan', 'jabatan', 'golongan', 'pangkat', 'bidangs'));
    }

    // Menyimpan data dosen baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'password' => 'required',
            'pendidikan' => 'required',
            'id_bidang' => 'required|exists:bidangs,id_bidang',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_golongan' => 'required|exists:golongan,id_golongan',
            'id_pangkat' => 'required|exists:pangkat,id_pangkat',
            'alamat' => 'required',
            'email' => 'required|email|unique:dosens,email',
            'no_hp' => 'required',
            'foto' => 'required|image',
            'status' => 'required',
            'sinta' => 'nullable',
            'link_sinta' => 'nullable',
            'schoolar' => 'nullable',
        ]);

        $fotoPath = $request->file('foto')->store('images/dosen', 'public');

        $dosen = Dosen::create([
            'nidn' => $validatedData['nidn'],
            'nama' => $validatedData['nama'],
            'gender' => $validatedData['gender'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'password' => bcrypt($validatedData['password']),
            'pendidikan' => $validatedData['pendidikan'],
            'id_bidang' => $validatedData['id_bidang'],
            'id_jurusan' => $validatedData['id_jurusan'],
            'id_prodi' => $validatedData['id_prodi'],
            'id_jabatan' => $validatedData['id_jabatan'],
            'id_golongan' => $validatedData['id_golongan'],
            'id_pangkat' => $validatedData['id_pangkat'],
            'alamat' => $validatedData['alamat'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'foto' => $fotoPath,
            'sinta' => $validatedData['sinta'],
            'link_sinta' => $validatedData['link_sinta'],
            'schoolar' => $validatedData['schoolar'],
            'status' => $validatedData['status'],
        ]);

        $user = User::create([
            'username' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'name' => $validatedData['nama'],
            'level_id' => 3, // Sesuaikan level sesuai kebutuhan
        ]);

        $dosen->user_id = $user->id_user;
        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    // Menampilkan detail dosen
    public function show($id_dosen)
    {
        $dosen = Dosen::where('id_dosen', $id_dosen)->firstOrFail();
        return view('admin.dosen.show', compact('dosen'));
    }

    // Menampilkan form edit dosen
    public function edit($id)
    {
        $bidangs = Bidang::all();
        $golongan = Golongan::all();
        $pangkat = Pangkat::all();
        $jabatan = Jabatan::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $dosen = Dosen::findOrFail($id);

        return view('admin.dosen.edit', compact('dosen', 'jurusan', 'prodi', 'jabatan', 'golongan', 'pangkat', 'bidangs'));
    }

    // Memperbarui data dosen
    public function update(Request $request, $id)
    {


        $validatedData = $request->validate([
            'nidn' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'password' => 'sometimes',
            'pendidikan' => 'required',
            'id_bidang' => 'required|exists:bidangs,id_bidang',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_golongan' => 'required|exists:golongan,id_golongan',
            'id_pangkat' => 'required|exists:pangkat,id_pangkat',
            'alamat' => 'required',
            'email' => 'required|email|unique:dosens,email,' . $id . ',id_dosen',
            'no_hp' => 'required',
            'foto' => 'sometimes|image',
            'sinta' => 'nullable',
            'link_sinta' => 'nullable',
            'schoolar' => 'nullable',
            'status' => 'required',
        ]);

        $dosen = Dosen::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/dosen', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $dosen->update($data);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    // Menghapus data dosen
    public function destroy($id)
    {
        Dosen::destroy($id);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}

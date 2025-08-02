<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['prodi', 'jurusan'])->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        $jurusan = Jurusan::all();
        return view('admin.mahasiswa.create', compact('prodi', 'jurusan'));
    }

    public function getProdi($id_jurusan)
    {
        $prodi = Prodi::where('id_jurusan', $id_jurusan)->get();
        return response()->json($prodi);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'gender' => 'required',
            'password' => 'required|min:6',
            'tanggal_daftar' => 'required|date',
            'akses' => 'required|integer',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        // Create Mahasiswa record
        $mahasiswa = Mahasiswa::create([
            'nim' => $validatedData['nim'],
            'nama' => $validatedData['nama'],
            'gender' => $validatedData['gender'],
            'password' => bcrypt($validatedData['password']),
            'foto' => $validatedData['foto'] ?? null,
            'akses' => $validatedData['akses'],
            'tanggal_daftar' => $validatedData['tanggal_daftar'],
            'id_jurusan' => $validatedData['id_jurusan'],
            'id_prodi' => $validatedData['id_prodi'],
        ]);

        // Create associated User for Mahasiswa
        $user = User::create([
            'username' => $validatedData['nim'],
            'password' => bcrypt($validatedData['password']),
            'name' => $validatedData['nama'],
            'level_id' => 4, // Adjust level as needed
        ]);

        // Link Mahasiswa with User
        $mahasiswa->user_id = $user->id_user;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodi = Prodi::all();
        $jurusan = Jurusan::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodi', 'jurusan'));
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with(['prodi', 'jurusan'])->findOrFail($id);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
            'nama' => 'required',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'gender' => 'required',
            'password' => 'required|min:6',
            'tanggal_daftar' => 'required|date',
            'akses' => 'required|integer',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        // Update Mahasiswa record
        $mahasiswa->update($validatedData);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}

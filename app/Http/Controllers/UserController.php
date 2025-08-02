<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('level')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('username', 'like', "%{$search}%"); // Ganti email dengan username
            })
            ->paginate(10); // Menampilkan 10 pengguna per halaman

        return view('users.index', compact('users'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        $levels = Level::all(); // Ambil data level untuk dropdown
        return view('users.create', compact('levels'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'level_id' => 'required|exists:levels,level_id',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'level_id' => $request->level_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $levels = Level::all(); // Ambil semua level untuk dropdown
        return view('users.edit', compact('user', 'levels'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id . ',id_user|max:255', // Ganti email dengan username
            'level_id' => 'required|exists:levels,level_id',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->username = $request->username; // Ganti email dengan username
        $user->level_id = $request->level_id;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}

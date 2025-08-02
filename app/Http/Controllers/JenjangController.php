<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;



class JenjangController extends Controller
{

    public function index()
    {
        $jenjang = Jenjang::all();
        $title = 'Jenjang';
        return view('admin.jenjang.index', compact('jenjang', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Jenjang';
        return view('admin.jenjang.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenjang' => ['required', 'max:255', 'in:D2,D3,D4,S2'],
            'keterangan' => 'nullable'
        ]);

        Jenjang::create($validated);
        return redirect()->route('jenjang.index')->with('success', 'Data jenjang berhasil ditambahkan');
    }

    public function show(Jenjang $jenjang)
    {
        return view('admin.jenjang.show', compact('jenjang'));
    }

    public function edit(Jenjang $jenjang)
    {
        return view('admin.jenjang.edit', compact('jenjang'));
    }

    public function update(Request $request, Jenjang $jenjang)
    {
        $validated = $request->validate([
            'nama_jenjang' => ['required', 'max:255', 'in:D2,D3,D4,S2'],
            'keterangan' => 'nullable'
        ]);

        $jenjang->update($validated);
        return redirect()->route('jenjang.index')->with('success', 'Data jenjang berhasil diperbarui');
    }

    public function destroy(Jenjang $jenjang)
    {
        $jenjang->delete();
        return redirect()->route('jenjang.index')->with('success', 'Data jenjang berhasil dihapus');
    }
}

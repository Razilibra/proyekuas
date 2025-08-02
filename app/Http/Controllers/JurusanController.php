<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create()
    {

        $jurusan = Jurusan::all();
        return view('admin.jurusan.create',compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
            'keterangan' => 'required',

        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Jurusan created successfully.');
    }

    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.show', compact('jurusan'));
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
            'keterangan' => 'required',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Jurusan updated successfully.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan deleted successfully.');
    }
}

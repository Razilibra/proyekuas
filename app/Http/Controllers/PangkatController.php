<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pangkat = Pangkat::all();
        return view('admin.pangkat.index',compact('pangkat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pangkat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pangkat' => 'required|',
        ]);

        Pangkat::create($request->all());
        return redirect()->route('pangkat.index')->with('success','Pangkat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pangkat = Pangkat::findOrFail($id);
        return view('admin.pangkat.show',compact('pangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pangkat = Pangkat::findOrFail($id);
        return view('admin.pangkat.edit',compact('pangkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pangkat = Pangkat::findOrFail($id);
        $validated = $request->validate([
            'pangkat' => 'required|string|max:255',
        ]);
        $pangkat->update($validated);
        return redirect()->route('pangkat.index')->with('success','Pangkat berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pangkat = Pangkat::findOrFail($id);
        $pangkat->delete();
        return redirect()->route('pangkat.index')->with('success','Pangkat berhasil dihapus');
    }
}

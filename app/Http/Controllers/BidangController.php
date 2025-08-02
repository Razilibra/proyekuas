<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangs = Bidang::all();
        return view('admin.bidangs.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bidangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bidang' => 'required|string|max:255',
        ]);

        Bidang::create($request->all());

        return redirect()->route('bidang.index')
                         ->with('success', 'Bidang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bidang $bidang)
    {
        return view('admin.bidangs.show', compact('bidang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        return view('admin.bidangs.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidang $bidang)
    {
        $request->validate([
            'bidang' => 'required|string|max:255',
        ]);

        $bidang->update($request->all());

        return redirect()->route('bidang.index')
                         ->with('success', 'Bidang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();

        return redirect()->route('bidang.index')
                         ->with('success', 'Bidang berhasil dihapus.');
    }
}

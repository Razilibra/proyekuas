<?php
namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Sesi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class SidangController extends Controller
{
    public function index()
    {
        $sidang = Sidang::with(['sesi', 'ruangan'])->get();
        return view('admin.sidang.index', compact('sidang'));
    }

    public function create()
    {
        $sesi = Sesi::all();
        $ruangan = Ruangan::all();
        return view('admin.sidang.create', compact('sesi', 'ruangan'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'tanggal' => 'required|date',
            'id_sesi' => 'required|exists:sesi,id',
            'id_ruangan' => 'required|exists:ruangan,id',
        ]);

        // Check for duplicate entries based on unique constraints
        $exists = Sidang::where('tanggal', $request->tanggal)
            ->where('id_sesi', $request->id_sesi)
            ->where('id_ruangan', $request->id_ruangan)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'error' => 'Sidang with the same date, session, and room already exists.'
            ])->withInput();
        }

        // Create a new Sidang entry
        Sidang::create([
            'tanggal' => $request->tanggal,
            'id_sesi' => $request->id_sesi,
            'id_ruangan' => $request->id_ruangan,
        ]);

        return redirect()->route('sidang.index')->with('success', 'Sidang berhasil ditambahkan.');
    }

    public function show(Sidang $sidang)
    {
        $sidang->load(['sesi', 'ruangan']);
        return view('admin.sidang.show', compact('sidang'));
    }

    public function edit(Sidang $sidang)
    {
        $sesi = Sesi::all();
        $ruangan = Ruangan::all();
        return view('admin.sidang.edit', compact('sidang', 'sesi', 'ruangan'));
    }

    public function update(Request $request, Sidang $sidang)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_sesi' => 'required|exists:sesi,id',
            'id_ruangan' => 'required|exists:ruangan,id',
        ]);

        // Check for duplicate entry excluding the current sidang
        $exists = Sidang::where('tanggal', $request->tanggal)
            ->where('id_sesi', $request->id_sesi)
            ->where('id_ruangan', $request->id_ruangan)
            ->where('id', '!=', $sidang->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'error' => 'Sidang with the same date, session, and room already exists.'
            ])->withInput();
        }

        // Update the Sidang entry
        $sidang->update([
            'tanggal' => $request->tanggal,
            'id_sesi' => $request->id_sesi,
            'id_ruangan' => $request->id_ruangan,
        ]);

        return redirect()->route('sidang.index')->with('success', 'Sidang berhasil diperbarui.');
    }

    public function destroy(Sidang $sidang)
    {
        $sidang->delete();
        return redirect()->route('sidang.index')->with('success', 'Sidang berhasil dihapus.');
    }
}

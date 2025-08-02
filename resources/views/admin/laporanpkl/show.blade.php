@extends('admin.pages.home')

@section('title', 'Detail Laporan PKL')

@section('content')
    <h2 class="text-center">Detail Laporan PKL</h2>

    <div class="mb-3">
        <strong>No BP:</strong> {{ $laporan_pkl->nobp }}
    </div>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $laporan_pkl->nama }}
    </div>
    <div class="mb-3">
        <strong>Prodi:</strong> {{ $laporan_pkl->prodi }}
    </div>
    <div class="mb-3">
        <strong>Nama Perusahaan:</strong> {{ $laporan_pkl->nama_perusahaan }}
    </div>
    <div class="mb-3">
        <strong>Alamat:</strong> {{ $laporan_pkl->alamat }}
    </div>
    <div class="mb-3">
        <strong>File:</strong> <a href="{{ asset('storage/' . $laporan_pkl->file) }}" target="_blank">Download</a>
    </div>
    <div class="mb-3">
        <strong>Tahun Ajaran:</strong> {{ $laporan_pkl->tahun_ajaran }}
    </div>

    <form action="{{ route('laporan_pkl.destroy', $laporan_pkl->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Laporan PKL</button>
    </form>
@endsection

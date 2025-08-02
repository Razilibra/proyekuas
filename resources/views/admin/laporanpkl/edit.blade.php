@extends('admin.pages.home')


@section('title', 'Edit Laporan PKL')

@section('content')
    <h2 class="text-center">Edit Laporan PKL</h2>

    <form action="{{ route('laporan_pkl.update', $laporan_pkl->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>No BP</label>
            <input type="text" name="nobp" class="form-control" value="{{ $laporan_pkl->nobp }}" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $laporan_pkl->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Prodi</label>
            <input type="text" name="prodi" class="form-control" value="{{ $laporan_pkl->prodi }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" value="{{ $laporan_pkl->nama_perusahaan }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $laporan_pkl->alamat }}" required>
        </div>
        <div class="mb-3">
            <label>File</label>
            <input type="file" name="file" class="form-control">
            <p>File saat ini: <a href="{{ asset('storage/' . $laporan_pkl->file) }}" target="_blank">Download</a></p>
        </div>
        <div class="mb-3">
            <label>Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" value="{{ $laporan_pkl->tahun_ajaran }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

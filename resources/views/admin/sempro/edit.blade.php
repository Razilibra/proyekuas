@extends('admin.pages.home')

@section('content')
    <h1 class="title">
        <i class="bi bi-pencil-square"></i> Edit Sempro
    </h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sempro.update', $sempro->id_sempro) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_mhs" class="form-label">Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" value="{{ $mahasiswas->nama }}" readonly>
            <input type="hidden" name="id_mhs" id="id_mhs" value="{{ $mahasiswas->id_mhs }}">
        </div>

        <div class="mb-3">
            <label for="id_pengajuan" class="form-label">Judul Tugas Akhir</label>
            <select class="form-select" id="id_pengajuan" name="id_pengajuan" required>
                <option value="">Pilih Judul</option>
                @foreach ($pengajuans as $pengajuan)
                    <option value="{{ $pengajuan->id_tugasakhir }}"
                        {{ old('id_tugasakhir', $sempro->id_pengajuan) == $pengajuan->id_tugasakhir ? 'selected' : '' }}>
                        {{ $pengajuan->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file_sempro" class="form-label">File Seminar Proposal</label>
            <input type="file" class="form-control" id="file_sempro" name="file_sempro">
            @if ($sempro->file_sempro)
                <small class="form-text text-muted">File saat ini: <a href="{{ asset('storage/' . $sempro->file_sempro) }}"
                        target="_blank">Lihat File</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sempro.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

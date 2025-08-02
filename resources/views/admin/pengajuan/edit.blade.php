@extends('admin.pages.home')

@section('title', 'Edit Data Pengajuan')

@section('content')
    <h2 class="text-center">Edit Data Pengajuan</h2>

    <form action="/pengajuan/{{$pengajuan->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" class="form-control" name="judul" value="{{ $pengajuan->judul }}">
        </div>

        <div class="mb-3">
            <label>Mahasiswa</label>
            @if ($mahasiswas)
                <input type="text" value="{{ $mahasiswas->nama }}" class="form-control" disabled>
                <input type="hidden" value="{{ $mahasiswas->mahasiswa_id }}" name="mahasiswa_id">
            @else
                <select class="form-control" name="mahasiswa_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach ($datamahasiswa as $mhs)
                        <option value="{{ $mhs->mahasiswa_id }}"
                            {{ old('mahasiswa_id') == $mhs->mahasiswa_id ? 'selected' : '' }}>
                            {{ $mhs->nama }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="mb-3">
            <label>Bidang</label>
            <select class="form-control" name="bidang_id" required>
                <option value="">Pilih Bidang</option>
                @foreach ($bidang as $bidangs)
                    <option value="{{ $bidangs->id }}" {{ $bidangs->id == $pengajuan->bidang_id ? 'selected' : '' }}>
                        {{ $bidangs->bidang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>IPK</label>
            <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" 
                value="{{ old('ipk', $pengajuan->ipk) }}" required>
            @error('ipk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Proposal Tugas Akhir</label>
            <input type="file" class="form-control" name="proposal_tugas_akhir">
            @if ($pengajuan->proposal_tugas_akhir)
                <p>File saat ini: <a href="{{ asset('storage/' . $pengajuan->proposal_tugas_akhir) }}" target="_blank">
                    {{ $pengajuan->proposal_tugas_akhir }}</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

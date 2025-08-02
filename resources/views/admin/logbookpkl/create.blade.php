
@extends('admin.pages.home')

@section('title', 'Tambah Logbook PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Logbook PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswapkllogbook.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                          
                    <div class="mb-3">
                        <label for="id_registrasi_pkl">Mahasiswa <span class="text-danger">*</span></label>
                        <select name="id_registrasi_pkl" id="id_registrasi_pkl" class="form-control @error('id_registrasi_pkl') is-invalid @enderror">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($registrasi_pkl as $mahasiswapkl)
                                <option value="{{ $mahasiswapkl->id_registrasi_pkl }}"
                                    {{ old('id_registrasi_pkl') == $mahasiswapkl->id_registrasi_pkl ? 'selected' : '' }}>
                                    {{ $mahasiswapkl->mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_registrasi_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan_awal" class="form-label">Tanggal Kegiatan Awal</label>
                            <input type="date" class="form-control @error('tanggal_kegiatan_awal') is-invalid @enderror" id="tanggal_kegiatan_awal" name="tanggal_kegiatan_awal" required>
                            @error('tanggal_kegiatan_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan_akhir" class="form-label">Tanggal Kegiatan Akhir</label>
                            <input type="date" class="form-control @error('tanggal_kegiatan_akhir') is-invalid @enderror" id="tanggal_kegiatan_akhir" name="tanggal_kegiatan_akhir" required>
                            @error('tanggal_kegiatan_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" rows="3" required></textarea>
                            @error('kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_dokumentasi" class="form-label">File Dokumentasi</label>
                            <input type="file" class="form-control @error('file_dokumentasi') is-invalid @enderror" id="file_dokumentasi" name="file_dokumentasi">
                            @error('file_dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" rows="2"></textarea>
                            @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('mahasiswapkllogbook.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('admin.pages.home')

@section('title', 'Edit Logbook PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Logbook PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswapkllogbook.update', $logbook) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_mahasiswa_pkl" class="form-label">Mahasiswa PKL</label>
                            <input type="text" class="form-control" value="{{ $logbook->mahasiswaPkl->mahasiswa->nama }}" disabled>
                            <input type="hidden" name="id_mahasiswa_pkl" value="{{ $logbook->id_mahasiswa_pkl }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan_awal" class="form-label">Tanggal Kegiatan Awal</label>
                            <input type="date" class="form-control @error('tanggal_kegiatan_awal') is-invalid @enderror" id="tanggal_kegiatan_awal" name="tanggal_kegiatan_awal" value="{{ $logbook->tanggal_kegiatan_awal }}" required>
                            @error('tanggal_kegiatan_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan_akhir" class="form-label">Tanggal Kegiatan Akhir</label>
                            <input type="date" class="form-control @error('tanggal_kegiatan_akhir') is-invalid @enderror" id="tanggal_kegiatan_akhir" name="tanggal_kegiatan_akhir" value="{{ $logbook->tanggal_kegiatan_akhir }}" required>
                            @error('tanggal_kegiatan_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" rows="3" required>{{ $logbook->kegiatan }}</textarea>
                            @error('kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_dokumentasi" class="form-label">File Dokumentasi</label>
                            @if($logbook->file_dokumentasi)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/'.$logbook->file_dokumentasi) }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-file"></i> Lihat File Saat Ini
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('file_dokumentasi') is-invalid @enderror" id="file_dokumentasi" name="file_dokumentasi">
                            @error('file_dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" rows="2">{{ $logbook->komentar }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="validasi" class="form-label">Status Validasi</label>
                            <select class="form-control @error('validasi') is-invalid @enderror" id="validasi" name="validasi" required>
                                <option value="0" {{ $logbook->validasi == 0 ? 'selected' : '' }}>Belum Divalidasi</option>
                                <option value="1" {{ $logbook->validasi == 1 ? 'selected' : '' }}>Divalidasi</option>
                            </select>
                            @error('validasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('mahasiswapkllogbook.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

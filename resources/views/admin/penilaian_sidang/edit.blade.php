@extends('admin.pages.home')

@section('title', 'Edit Penilaian Sidang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Edit Penilaian Sidang
                </div>
                <div class="card-body">
                    <form action="{{ route('penilaian_sidang.update', $penilaianSidang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id_mahasiswa_pkl" class="form-label">Mahasiswa PKL</label>
                            <select class="form-control" name="id_mahasiswa_pkl" required>
                                @foreach($mahasiswaPkl as $mahasiswa)
                                    <option value="{{ $mahasiswa->id_mahasiswa_pkl }}"
                                        {{ $penilaianSidang->id_mahasiswa_pkl == $mahasiswa->id_mahasiswa_pkl ? 'selected' : '' }}>
                                        {{ $mahasiswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_dosen" class="form-label">Dosen</label>
                            <select class="form-control" name="id_dosen" required>
                                @foreach($dosen as $dsn)
                                    <option value="{{ $dsn->id_dosen }}"
                                        {{ $penilaianSidang->id_dosen == $dsn->id_dosen ? 'selected' : '' }}>
                                        {{ $dsn->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" name="posisi" value="{{ $penilaianSidang->posisi }}">
                        </div>
                        <div class="mb-3">
                            <label for="bahasa" class="form-label">Bahasa dan Tata Tulis Laporan</label>
                            <input type="text" class="form-control" name="bahasa" value="{{ $penilaianSidang->bahasa }}">
                        </div>
                        <div class="mb-3">
                            <label for="analisis" class="form-label">Analisis Masalah</label>
                            <input type="text" class="form-control" name="analisis" value="{{ $penilaianSidang->analisis }}">
                        </div>
                        <div class="mb-3">
                            <label for="sikap" class="form-label">Nilai Sikap</label>
                            <input type="text" class="form-control" name="sikap" value="{{ $penilaianSidang->sikap }}">
                        </div>
                        <div class="mb-3">
                            <label for="komunikasi" class="form-label">Komunikasi</label>
                            <input type="text" class="form-control" name="komunikasi" value="{{ $penilaianSidang->komunikasi }}">
                        </div>
                        <div class="mb-3">
                            <label for="penyajian" class="form-label">Sistematika Penyajian</label>
                            <input type="text" class="form-control" name="penyajian" value="{{ $penilaianSidang->penyajian }}">
                        </div>
                        <div class="mb-3">
                            <label for="penguasaan" class="form-label">Penguasaan Materi</label>
                            <input type="text" class="form-control" name="penguasaan" value="{{ $penilaianSidang->penguasaan }}">
                        </div>
                        <div class="mb-3">
                            <label for="total_nilai" class="form-label">Total Nilai</label>
                            <input type="number" class="form-control" name="total_nilai" value="{{ $penilaianSidang->total_nilai }}" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

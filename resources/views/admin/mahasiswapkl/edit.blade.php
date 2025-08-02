
@extends('admin.pages.home')

@section('title', 'Edit Data Mahasiswa PKL')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Mahasiswa PKL</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswapkl.update', $mahasiswaPkl->id_mahasiswa_pkl) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <select class="form-control @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa">
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswa as $mhs)
                                    <option value="{{ $mhs->id_mahasiswa }}" {{ old('id_mahasiswa', $mahasiswaPkl->id_mahasiswa) == $mhs->id_mahasiswa ? 'selected' : '' }}>
                                        {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="form-label">Judul PKL</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $mahasiswaPkl->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ruangan_sidang" class="form-label">Ruangan Sidang</label>
                            <input type="text" class="form-control @error('ruangan_sidang') is-invalid @enderror" id="ruangan_sidang" name="ruangan_sidang" value="{{ old('ruangan_sidang', $mahasiswaPkl->ruangan_sidang) }}">
                            @error('ruangan_sidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_tempat_pkl" class="form-label">Tempat PKL</label>
                            <select class="form-control @error('id_tempat_pkl') is-invalid @enderror" id="id_tempat_pkl" name="id_tempat_pkl">
                                <option value="">Pilih Tempat PKL</option>
                                @foreach($tempat_pkl as $tempat)
                                    <option value="{{ $tempat->id_tempat_pkl }}" {{ old('id_tempat_pkl', $mahasiswaPkl->id_tempat_pkl) == $tempat->id_tempat_pkl ? 'selected' : '' }}>
                                        {{ $tempat->nama_perusahaan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tempat_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_pkl" class="form-label">Tahun PKL</label>
                            <input type="text" class="form-control @error('tahun_pkl') is-invalid @enderror" id="tahun_pkl" name="tahun_pkl" value="{{ old('tahun_pkl', $mahasiswaPkl->tahun_pkl) }}">
                            @error('tahun_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                            <input type="text" class="form-control @error('dosen_pembimbing') is-invalid @enderror" id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing', $mahasiswaPkl->dosen_pembimbing) }}">
                            @error('dosen_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dosen_penguji" class="form-label">Dosen Penguji</label>
                            <input type="text" class="form-control @error('dosen_penguji') is-invalid @enderror" id="dosen_penguji" name="dosen_penguji" value="{{ old('dosen_penguji', $mahasiswaPkl->dosen_penguji) }}">
                            @error('dosen_penguji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pembimbing_pkl" class="form-label">Pembimbing PKL</label>
                            <input type="text" class="form-control @error('pembimbing_pkl') is-invalid @enderror" id="pembimbing_pkl" name="pembimbing_pkl" value="{{ old('pembimbing_pkl', $mahasiswaPkl->pembimbing_pkl) }}">
                            @error('pembimbing_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai_pembimbing_industri" class="form-label">Nilai Pembimbing Industri</label>
                            <input type="number" step="0.01" class="form-control @error('nilai_pembimbing_industri') is-invalid @enderror" id="nilai_pembimbing_industri" name="nilai_pembimbing_industri" value="{{ old('nilai_pembimbing_industri', $mahasiswaPkl->nilai_pembimbing_industri) }}">
                            @error('nilai_pembimbing_industri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_sidang" class="form-label">Tanggal Sidang</label>
                            <input type="date" class="form-control @error('tanggal_sidang') is-invalid @enderror" id="tanggal_sidang" name="tanggal_sidang" value="{{ old('tanggal_sidang', $mahasiswaPkl->tanggal_sidang) }}">
                            @error('tanggal_sidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rekomendasi" class="form-label">Rekomendasi</label>
                            <input type="text" class="form-control @error('rekomendasi') is-invalid @enderror" id="rekomendasi" name="rekomendasi" value="{{ old('rekomendasi', $mahasiswaPkl->rekomendasi) }}">
                            @error('rekomendasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="informasi_detail" class="form-label">Informasi Detail</label>
                            <textarea class="form-control @error('informasi_detail') is-invalid @enderror" id="informasi_detail" name="informasi_detail" rows="3">{{ old('informasi_detail', $mahasiswaPkl->informasi_detail) }}</textarea>
                            @error('informasi_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokument_nilai_industri" class="form-label">Dokumen Nilai Industri</label>
                            <input type="file" class="form-control @error('dokument_nilai_industri') is-invalid @enderror" id="dokument_nilai_industri" name="dokument_nilai_industri">
                            @error('dokument_nilai_industri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokument_pkl" class="form-label">Dokumen PKL</label>
                            <input type="file" class="form-control @error('dokument_pkl') is-invalid @enderror" id="dokument_pkl" name="dokument_pkl">
                            @error('dokument_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokument_pkl_revisi" class="form-label">Dokumen PKL Revisi</label>
                            <input type="file" class="form-control @error('dokument_pkl_revisi') is-invalid @enderror" id="dokument_pkl_revisi" name="dokument_pkl_revisi">
                            @error('dokument_pkl_revisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokument_kuisioner" class="form-label">Dokumen Kuisioner</label>
                            <input type="file" class="form-control @error('dokument_kuisioner') is-invalid @enderror" id="dokument_kuisioner" name="dokument_kuisioner">
                            @error('dokument_kuisioner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('mahasiswapkl.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

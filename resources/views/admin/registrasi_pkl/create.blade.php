@extends('admin.pages.home')
@section('title', 'Tambah Registrasi PKL')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registrasi PKL</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('registrasipkl.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="id_mahasiswa">Mahasiswa</label>
                    <select name="id_mahasiswa" class="form-control @error('id_mahasiswa') is-invalid @enderror" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswa as $mhs)
                            <option value="{{ $mhs->id_mahasiswa }}">{{ $mhs->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_mahasiswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_tempat_pkl" class="form-label">Tempat PKL</label>
                    <select class="form-control @error('id_tempat_pkl') is-invalid @enderror" id="id_tempat_pkl" name="id_tempat_pkl">
                        <option value="">Pilih Tempat PKL</option>
                        @foreach($tempat_pkl as $tempat_pkl)
                            <option value="{{ $tempat_pkl->id_tempat_pkl }}" {{ old('id_tempat_pkl') == $tempat_pkl->id_tempat_pkl ? 'selected' : '' }}>
                                {{ $tempat_pkl->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_tempat_pkl')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                    <textarea class="form-control @error('alamat_perusahaan') is-invalid @enderror"
                            name="alamat_perusahaan" rows="3" placeholder="Masukkan Alamat Perusahaan" required>{{ old('alamat_perusahaan') }}</textarea>
                    @error('alamat_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">File Pendukung</label>
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror"
                           name="file" placeholder="Pilih File Pendukung">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('registrasipkl.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

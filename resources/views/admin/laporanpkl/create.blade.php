@extends('admin.pages.home')

@section('title', 'Tambah Laporan PKL')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Laporan PKL</h6>
                    <a href="{{ route('laporan_pkl.index') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('laporan_pkl.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nobp" class="form-label">No BP <span class="text-danger">*</span></label>
                                    <input type="text" name="nobp" id="nobp" class="form-control @error('nobp') is-invalid @enderror" value="{{ old('nobp') }}" placeholder="Masukkan No BP" required>
                                    @error('nobp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan Nama" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                    <input type="text" name="prodi" id="prodi" class="form-control @error('prodi') is-invalid @enderror" value="{{ old('prodi') }}" placeholder="Masukkan Program Studi" required>
                                    @error('prodi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan') }}" placeholder="Masukkan Nama Perusahaan" required>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan Alamat" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                        @php
                                            $currentYear = date('Y');
                                        @endphp
                                        @for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++)
                                            <option value="{{ $i }}/{{ $i + 1 }}" {{ old('tahun_ajaran') == "$i/$i+1" ? 'selected' : '' }}>
                                                {{ $i }}/{{ $i + 1 }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('tahun_ajaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@extends('admin.pages.home')

@section('title', 'Daftar Prodi')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Program Studi</h6>
                    <a href="{{ route('prodi.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="{{ route('prodi.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                    <select class="form-control @error('nama_prodi') is-invalid @enderror" id="nama_prodi" name="nama_prodi" required>
                                        <option value="">Pilih Program Studi</option>
                                        <option value="Teknologi Rekayasa Perangkat Lunak" {{ old('nama_prodi') == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Teknologi Rekayasa Perangkat Lunak</option>
                                        <option value="Manajemen Informatika" {{ old('nama_prodi') == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                                        <option value="Animasi" {{ old('nama_prodi') == 'Animasi' ? 'selected' : '' }}>Animasi</option>
                                        <option value="Teknik Komputer" {{ old('nama_prodi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                                        <option value="Perancangan Irigasi dan Rawa" {{ old('nama_prodi') == 'Perancangan Irigasi dan Rawa' ? 'selected' : '' }}>Perancangan Irigasi dan Rawa</option>
                                        <option value="Perancangan Jembatan dan Jalan" {{ old('nama_prodi') == 'Perancangan Jembatan dan Jalan' ? 'selected' : '' }}>Perancangan Jembatan dan Jalan</option>
                                    </select>
                                    @error('nama_prodi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_jurusan') is-invalid @enderror" id="id_jurusan" name="id_jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($jurusan as $j)
                                            <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_jenjang') is-invalid @enderror" id="id_jenjang" name="id_jenjang" required>
                                        <option value="">Pilih Jenjang</option>
                                        @foreach ($jenjang as $js)
                                            <option value="{{ $js->id_jenjang }}" {{ old('id_jenjang') == $js->id_jenjang ? 'selected' : '' }}>{{ $js->nama_jenjang }}</option>
                                        @endforeach
                                    </select>
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

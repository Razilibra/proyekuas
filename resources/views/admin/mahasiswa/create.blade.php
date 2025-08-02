@extends('admin.pages.home')

@section('title', 'Tambah Data Mahasiswa')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Mahasiswa</h6>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <!-- Input NIM -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                                    <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Input Program Studi -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_prodi') is-invalid @enderror" id="id_prodi" name="id_prodi" required>
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id_prodi }}" {{ old('id_prodi') == $p->id_prodi ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_prodi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Jurusan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_jurusan') is-invalid @enderror" id="id_jurusan" name="id_jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($jurusan as $j)
                                            <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Input Gender -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Input Foto -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto (Opsional)</label>
                                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Akses -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="akses" class="form-label">Akses <span class="text-danger">*</span></label>
                                    <select class="form-control @error('akses') is-invalid @enderror" id="akses" name="akses" required>
                                        <option value="">Pilih Akses</option>
                                        <option value="1" {{ old('akses') == 1 ? 'selected' : '' }}>Administrator</option>
                                        <option value="2" {{ old('akses') == 2 ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value="3" {{ old('akses') == 3 ? 'selected' : '' }}>Dosen</option>
                                    </select>
                                    @error('akses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Input Tanggal Daftar -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control @error('tanggal_daftar') is-invalid @enderror" value="{{ old('tanggal_daftar') }}" required>
                                    @error('tanggal_daftar')
                                        <div class="invalid-feedback">{{ $message }}</div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_jurusan').change(function() {
                var id_jurusan = $(this).val();
                if (id_jurusan) {
                    $.ajax({
                        url: '/mahasiswa/getProdi/' + id_jurusan,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_prodi').empty(); // Kosongkan dropdown Prodi
                            $('#id_prodi').append('<option value="">Pilih Prodi</option>');
                            $.each(data, function(key, value) {
                                $('#id_prodi').append('<option value="' + value
                                    .id_prodi + '">' + value.prodi + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // Tampilkan kesalahan di konsol
                        }
                    });
                } else {
                    $('#id_prodi').empty(); // Kosongkan dropdown Prodi jika tidak ada jurusan yang dipilih
                    $('#id_prodi').append('<option value="">Pilih Prodi</option>');
                }
            });
        });
    </script>


@endsection

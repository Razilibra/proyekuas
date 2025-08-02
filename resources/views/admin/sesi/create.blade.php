@extends('admin.pages.home')

@section('title', 'Tambah Sesi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Sesi</h6>
                    <a href="{{ route('sesi.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="{{ route('sesi.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_sesi" class="form-label">Kode Sesi <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_sesi" id="kode_sesi" class="form-control @error('kode_sesi') is-invalid @enderror" value="{{ old('kode_sesi') }}" required>
                                    @error('kode_sesi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_sesi" class="form-label">Nama Sesi <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_sesi" id="nama_sesi" class="form-control @error('nama_sesi') is-invalid @enderror" value="{{ old('nama_sesi') }}" required>
                                    @error('nama_sesi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jam_berakhir" class="form-label">Jam Berakhir <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_berakhir" id="jam_berakhir" class="form-control @error('jam_berakhir') is-invalid @enderror" value="{{ old('jam_berakhir') }}" required>
                                    @error('jam_berakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

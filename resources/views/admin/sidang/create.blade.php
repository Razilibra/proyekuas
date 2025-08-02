@extends('admin.pages.home')

@section('title', 'Tambah Sidang')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Sidang</h6>
                    <a href="{{ route('sidang.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="{{ route('sidang.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_sesi" class="form-label">Sesi <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_sesi') is-invalid @enderror" id="id_sesi" name="id_sesi" required>
                                        <option value="">Pilih Sesi</option>
                                        @foreach ($sesi as $s)
                                            <option value="{{ $s->id }}" {{ old('id_sesi') == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama_sesi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_sesi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_ruangan') is-invalid @enderror" id="id_ruangan" name="id_ruangan" required>
                                        <option value="">Pilih Ruangan</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}" {{ old('id_ruangan') == $r->id ? 'selected' : '' }}>
                                                {{ $r->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_ruangan')
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


@endsection

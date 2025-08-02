@extends('admin.pages.home')
@section('title', 'Input Data Pengajuan')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Input Data Pengajuan</h6>
                    <a href="{{ route('pengajuan.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="/pengajuan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <!-- Input Judul -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul" required>
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Input Bidang -->
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_bidang" class="form-label">Bidang <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_bidang') is-invalid @enderror" name="id_bidang" required>
                                        <option value="">Pilih Bidang</option>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->id_bidang }}">{{ $bidang->bidang }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_bidang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}


                        <div class="row mb-3">
                            <!-- Input Mahasiswa -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mahasiswa_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                                    @if ($mahasiswa)
                                        <input type="text" value="{{ $mahasiswa->nama }}" class="form-control" disabled>
                                        <input type="hidden" value="{{ $mahasiswa->id_mahasiswa }}" name="mahasiswa_id">
                                    @else
                                        <select class="form-select @error('mahasiswa_id') is-invalid @enderror" id="mahasiswa_id" name="mahasiswa_id" required>
                                            <option value="">Pilih Mahasiswa</option>
                                            @foreach ($datamahasiswa as $mhs)
                                                <option value="{{ $mhs->id_mahasiswa }}" {{ old('mahasiswa_id') == $mhs->id_mahasiswa ? 'selected' : '' }}>{{ $mhs->nama }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    @error('mahasiswa_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Input IPK -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ipk" class="form-label">IPK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" value="{{ old('ipk') }}" placeholder="Masukkan IPK" required>
                                    @error('ipk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Input Proposal Tugas Akhir -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposal_tugas_akhir" class="form-label">Proposal Tugas Akhir <span class="text-danger">*</span></label>
                                    <input type="file" id="proposal_tugas_akhir" name="proposal_tugas_akhir" class="form-control @error('proposal_tugas_akhir') is-invalid @enderror" required>
                                    @error('proposal_tugas_akhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
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

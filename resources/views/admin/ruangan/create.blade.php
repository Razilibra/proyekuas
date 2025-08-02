@extends('admin.pages.home')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Ruangan</h6>
                    <a href="{{ route('ruangan.index') }}" class="btn btn-warning btn-sm">
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

                    <form action="{{ route('ruangan.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_ruangan" class="form-label">Kode Ruangan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('kode_ruangan') is-invalid @enderror" id="kode_ruangan" name="kode_ruangan" required>
                                        <option value="">Pilih Kode Ruangan</option>
                                        <option value="E-201">E-201</option>
                                        <option value="E-202">E-202</option>
                                        <option value="E-203">E-203</option>
                                        <option value="E-204">E-204</option>
                                        <option value="E-205">E-205</option>
                                        <option value="E-206">E-206</option>
                                        <option value="E-207">E-207</option>
                                        <option value="E-208">E-208</option>
                                        <option value="E-209">E-209</option>
                                        <option value="E-210">E-210</option>
                                        <option value="E-211">E-211</option>
                                    </select>
                                    @error('kode_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_ruangan" class="form-label">Nama Ruangan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan" name="nama_ruangan" required>
                                        <option value="">Pilih Nama Ruangan</option>
                                        <option value="Instalasi">Instalasi</option>
                                        <option value="Multimedia">Multimedia</option>
                                        <option value="Pemograman">Pemograman</option>
                                    </select>
                                    @error('nama_ruangan')
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

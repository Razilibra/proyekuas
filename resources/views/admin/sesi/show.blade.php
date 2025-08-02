@extends('admin.pages.home')

@section('title', 'Detail Sesi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Sesi</h6>
                    <a href="{{ route('sesi.index') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_sesi" class="form-label">Kode Sesi:</label>
                                <p class="form-control-static">{{ $sesi->kode_sesi }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_sesi" class="form-label">Nama Sesi:</label>
                                <p class="form-control-static">{{ $sesi->nama_sesi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                                <p class="form-control-static">{{ $sesi->jam_mulai }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_berakhir" class="form-label">Jam Berakhir:</label>
                                <p class="form-control-static">{{ $sesi->jam_berakhir }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <p class="form-control-static">{{ $sesi->keterangan ?? '-' }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('sesi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

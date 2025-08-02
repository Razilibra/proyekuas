
@extends('admin.pages.home')

@section('title', 'Detail Logbook PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Data Logbook PKL</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Nama Mahasiswa</th>
                                <td>{{ $logbook->Registrasipkl->mahasiswa->nama ?? '-'   }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kegiatan</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($logbook->tanggal_kegiatan_awal)->format('d/m/Y') }} -
                                    {{ \Carbon\Carbon::parse($logbook->tanggal_kegiatan_akhir)->format('d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Kegiatan</th>
                                <td>{{ $logbook->kegiatan }}</td>
                            </tr>
                            <tr>
                                <th>File Dokumentasi</th>
                                <td>
                                    @if($logbook->file_dokumentasi)
                                        <a href="{{ asset('storage/'.$logbook->file_dokumentasi) }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-file"></i> Lihat File
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Tidak ada file</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Komentar</th>
                                <td>{{ $logbook->komentar ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status Validasi</th>
                                <td>
                                    @if($logbook->validasi)
                                        <span class="badge bg-success">Divalidasi</span>
                                    @else
                                        <span class="badge bg-warning">Belum Divalidasi</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('mahasiswapkllogbook.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

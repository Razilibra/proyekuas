@extends('admin.pages.home')

@section('title', 'Data Logbook PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Logbook PKL</h6>
                    <a href="{{ route('mahasiswapkllogbook.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('mahasiswapkllogbook.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama mahasiswa..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal Kegiatan</th>
                                    {{-- <th>Kegiatan</th>
                                    <th>File Dokumentasi</th>
                                    <th>Komentar</th> --}}
                                    <th>Status Validasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa_log_book_pkl as $index => $logbook)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $logbook->Registrasipkl->mahasiswa->nama ?? '-'  }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($logbook->tanggal_kegiatan_awal)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($logbook->tanggal_kegiatan_akhir)->format('d/m/Y') }}
                                    </td>
                                    {{-- <td>{{ $logbook->kegiatan }}</td>
                                    <td>
                                        @if($logbook->file_dokumentasi)
                                            <a href="{{ asset('storage/'.$logbook->file_dokumentasi) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-file"></i> Lihat File
                                            </a>
                                        @else
                                            <span class="badge bg-secondary">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>{{ $logbook->komentar ?? '-' }}</td> --}}
                                    <td>
                                        @if($logbook->validasi)
                                            <span class="badge bg-success">Divalidasi</span>
                                        @else
                                            <span class="badge bg-warning">Belum Divalidasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mahasiswapkllogbook.show', $logbook) }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('mahasiswapkllogbook.edit', $logbook) }}" >
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            @if($logbook->validasi !== '1')
                                            <form action="{{ route('mahasiswapkllogbook.acc', $logbook->id_mahasiswa_pkl_log_book) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin meng-ACC data ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form action="{{ route('mahasiswapkllogbook.destroy', $logbook) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="mt-3">
                        {{ $mahasiswa_log_book_pkl->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

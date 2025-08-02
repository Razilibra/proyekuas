@extends('admin.pages.home')
@section('title', 'Data Pengajuan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan</h6>
                        @can('isMahasiswa')
                            <a href="/pengajuan/create" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Input Data
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if (session('pesan'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                {{ session('pesan') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul TA</th>
                                        <th>Mahasiswa</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pengajuans->count() > 0)
                                        @foreach ($pengajuans as $pengajuans)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengajuans->judul }}</td>
                                                <td>{{ $pengajuans->mahasiswapengajuan->nama }}</td>
                                                <td>{{ $pengajuans->status }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="/pengajuan/{{ $pengajuans->id_tugasakhir }}/edit"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('pengajuan.show', $pengajuans->id_tugasakhir) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        @can('isKaprodi')
                                                            <a href="{{ route('pengajuan.showTentukanPembimbing', $pengajuans->id_tugasakhir) }}"
                                                                class="btn btn-info btn-sm">
                                                                <i class="fas fa-book"></i>
                                                            </a>
                                                        @endcan
                                                        <form action="/pengajuan/{{ $pengajuans->id_tugasakhir }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin mau menghapus data?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Pengajuan tidak ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

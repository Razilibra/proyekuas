@extends('admin.pages.home')

@section('title', 'Daftar Laporan PKL')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Laporan PKL</h6>
                    <a href="{{ route('laporan_pkl.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Program Studi</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>File Laporan</th>
                                    <th>Tahun Ajaran</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporan_pkl as $laporan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $laporan->nama }}</td>
                                        <td>{{ $laporan->nobp }}</td>
                                        <td>{{ $laporan->prodi }}</td>
                                        <td>{{ $laporan->nama_perusahaan }}</td>
                                        <td>{{ $laporan->alamat }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('laporan_pkl.download', $laporan->id_laporan_pkl) }}" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <td>{{ $laporan->tahun_ajaran }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('laporan_pkl.edit', $laporan->id_laporan_pkl) }}" class="btn btn-warning btn-sm mb-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('laporan_pkl.destroy', $laporan->id_laporan_pkl) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data laporan PKL.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

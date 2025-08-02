@extends('admin.pages.home')

@section('title', 'Daftar Usulan PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Usulan PKL</h6>
                    <a href="{{ route('usulan_pkl.create') }}" class="btn btn-success btn-sm">
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
                        <div class="col-md-12">
                            <form action="{{ route('usulan_pkl.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Usulan PKL" value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tempat PKL</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Konfirmasi</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usulan_pkl as $index => $usulan)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $usulan->mahasiswa->nama ?? '-' }}</td>
                                        <td>{{ $usulan->tempatPkl->nama_perusahaan ?? '-' }}</td>
                                        <td>{{ $usulan->tahun_ajaran }}</td>
                                        <td class="text-center">
                                            @if ($usulan->konfirmasi == '1')
                                                <span class="badge bg-success">Dikonfirmasi</span>
                                            @else
                                                <span class="badge bg-danger">Belum</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('usulan_pkl.edit', $usulan->id_usulan_pkl) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if ($usulan->konfirmasi !== '1')
                                            <form action="{{ route('usulan_pkl.acc', $usulan->id_usulan_pkl) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin meng-ACC data ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif

                                            <form action="{{ route('usulan_pkl.destroy', $usulan->id_usulan_pkl) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data usulan PKL.</td>
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

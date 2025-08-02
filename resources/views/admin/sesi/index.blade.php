@extends('admin.pages.home')

@section('title', 'Daftar Sesi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Sesi</h6>
                    <a href="{{ route('sesi.create') }}" class="btn btn-success btn-sm">
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
                            <form action="{{ route('sesi.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Sesi" value="{{ request('search') }}">
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
                                    <th>Kode</th>
                                    <th>Nama Sesi</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Berakhir</th>
                                    <th>Keterangan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sesi as $index => $s)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $s->kode_sesi }}</td>
                                        <td>{{ $s->nama_sesi }}</td>
                                        <td>{{ $s->jam_mulai }}</td>
                                        <td>{{ $s->jam_berakhir }}</td>
                                        <td>{{ $s->keterangan }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('sesi.show', $s->id_sesi) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('sesi.edit', $s->id_sesi) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('sesi.destroy', $s->id_sesi) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

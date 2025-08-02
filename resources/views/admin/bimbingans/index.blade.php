@extends('admin.pages.home')

@section('title', 'Data Bimbingan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Bimbingan</h3>
            <div class="float-right">
                <a href="{{ route('admin.bimbingans.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Dosen</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bimbingans as $bimbingan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bimbingan->mahasiswa->nama }}</td>
                            <td>{{ $bimbingan->dosen->nama }}</td>
                            <td>{{ $bimbingan->judul }}</td>
                            <td>{{ $bimbingan->tanggal }}</td>
                            <td>{{ $bimbingan->status }}</td>
                            <td>
                                <a href="{{ route('admin.bimbingans.show', $bimbingan->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.bimbingans.edit', $bimbingan->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.bimbingans.destroy', $bimbingan->id) }}" method="POST" class="d-inline">
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
@endsection

@extends('admin.pages.home')

@section('title', 'Data Penilaian Sidang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penilaian Sidang</h6>
                    <a href="{{ route('penilaian_sidang.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Dosen</th>
                                    <th>Total Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penilaian_sidang as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->mahasiswaPkl->mahasiswa->nama }}</td>
                                    <td>{{ $data->dosen->nama }}</td>
                                    <td>{{ $data->total_nilai }}</td>
                                    <td>
                                        <a href="{{ route('penilaian_sidang.show', $data) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('penilaian_sidang.edit', $data) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('penilaian_sidang.destroy', $data) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

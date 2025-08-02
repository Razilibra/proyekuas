
@extends('admin.pages.home')

@section('title', 'Daftar Tempat PKL')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tempat PKL</h6>
                    <a href="{{ route('tempat_pkl.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat Perusahaan</th>
                                    <th>Kuota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempat_pkl as $key => $tempat)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tempat->nama_perusahaan }}</td>
                                    <td>{{ $tempat->alamat_perusahaan }}</td>
                                    <td>{{ $tempat->kuota }}</td>
                                    <td>
                                        <!-- Display status based on kuota -->
                                        @if ($tempat->kuota > 0)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tempat_pkl.show', $tempat->id_tempat_pkl) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tempat_pkl.edit', $tempat->id_tempat_pkl) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('tempat_pkl.destroy', $tempat->id_tempat_pkl) }}" method="POST" class="d-inline">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('admin.pages.home')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
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
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Program Studi</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Akses</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $key => $mhs)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->jurusan->nama_jurusan }}</td>
                                    <td>{{ $mhs->prodi->nama_prodi }}</td>
                                    <td>{{ $mhs->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>
                                        @if($mhs->akses == 1)
                                            Administrator
                                        @elseif($mhs->akses == 2)
                                            Mahasiswa
                                        @else
                                            Dosen
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi'])
                                        <a href="{{ route('mahasiswa.edit', $mhs->id_mahasiswa) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            @endcanany
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id_mahasiswa) }}" method="POST" class="d-inline">
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

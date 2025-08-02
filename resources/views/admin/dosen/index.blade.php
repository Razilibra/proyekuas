@extends('admin.pages.home')

@section('title', 'List of Dosen')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
                    <a href="{{ route('dosen.create') }}" class="btn btn-success btn-sm">
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
                            <form action="{{ route('dosen.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Dosen" value="{{ request('search') }}">
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
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    {{-- <th>Gender</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pendidikan</th>
                                    <th>Jabatan</th> --}}
                                    <th>Prodi</th>
                                    <th>Jurusan</th>
                                    {{-- <th>Golongan</th>
                                    <th>Pangkat</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No HP</th> --}}
                                    <th>Status</th>
                               {{--   <th>Foto</th>--}}
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosen as $index => $d)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $d->nidn }}</td>
                                        <td>{{ $d->nama }}</td>
                                        {{-- <td>{{ $d->gender }}</td>
                                        <td>{{ $d->tempat_lahir }}</td>
                                        <td>{{ $d->tgl_lahir }}</td>
                                        <td>{{ $d->pendidikan }}</td>
                                        <td>{{ $d->jabatan->jabatan_akademik }}</td> --}}
                                        <td>{{ $d->prodi->nama_prodi }}</td>
                                        <td>{{ $d->jurusan->nama_jurusan }}</td>
                                        {{-- <td>{{ $d->golongan->nama_golongan }}</td>
                                        <td>{{ $d->pangkat->nama_pangkat }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->no_hp }}</td> --}}
                                        <td>
                                            @if($d->status == 'Aktif')
                                                <span class="badge bg-success">{{ $d->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $d->status }}</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <img src="{{ asset('storage/'.$d->foto) }}" alt="Foto Dosen" width="50">
                                        </td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('dosen.show', $d->id_dosen) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dosen.edit', $d->id_dosen) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dosen.destroy', $d->id_dosen) }}" method="POST" style="display:inline;">
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

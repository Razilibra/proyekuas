@extends('admin.pages.home')

@section('title', 'Data Registrasi PKL')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Register PKL</h6>
            <div class="card-tools">
                <a href="{{ route('registrasipkl.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Perusahaan</th>

                            {{-- <th>File</th> --}}
                            <th>Status</th>
                            <th>Tanggal Registrasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrasi_pkl as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->mahasiswa->nama }}</td>
                            <td>{{ $data->tempatPkl->nama_perusahaan ?? '-' }}</td>
                            {{-- <td>{{ $data->alamat_perusahaan }}</td> --}}
                            {{-- <td>
                                @if($data->file)
                                    <a href="{{ asset('storage/'.$data->file) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file"></i> Lihat File
                                    </a>
                                @else
                                    <span class="badge badge-warning">Belum Upload</span>
                                @endif
                            </td> --}}

                            <td>
                                @if($data->konfirmasi == '0')
                                    <span class="badge badge-warning">Belum Dikonfirmasi</span>
                                @else
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">

                                    @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen','isMahasiswa'])
                                    <a href="{{ route('registrasipkl.show', $data) }}">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcanany

                                    @canany(['isAdministrator', 'isSuperAdmin', 'isKaprodi'])
                                    <a href="{{ route('registrasipkl.edit', $data) }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    </a>
                                    @endcanany
                                    @canany(['isAdministrator', 'isSuperAdmin', 'isKaprodi'])
                                    <form action="{{ route('registrasipkl.destroy', $data) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcanany
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endpush

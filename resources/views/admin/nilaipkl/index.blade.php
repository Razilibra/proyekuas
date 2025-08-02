@extends('admin.pages.home')

@section('title', 'Data Nilai PKL')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai PKL</h6>
            <div class="card-tools">
                <a href="{{ route('nilaipkl.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Nilai PKL
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Mahasiswa PKL</th>
                            <th>Total Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilai_pkl as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->dosen->nama ?? '-' }}</td>
                                <td>{{ $item->mahasiswaPkl->mahasiswa->nama ?? '-' }}</td>
                                <td>{{ $item->total_nilai }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        {{-- Tombol Lihat --}}
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('nilaipkl.show', $item->id_nilai_pkl) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        {{-- Tombol Edit --}}
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('nilaipkl.edit', $item->id_nilai_pkl) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                        {{-- Tombol Hapus --}}
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('nilaipkl.destroy', $item->id_nilai_pkl) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

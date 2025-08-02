@extends('admin.pages.home')

@section('content')
    <h1 class="title">
        <i class="bi bi-list-ul"></i> Data Sempro
    </h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row py-1 mt-5 mb-3">
        @can('isMahasiswa')
            <div class="d-flex align-items-center">
                <div class="col float-end" style="margin-right: 1rem;">
                    <a href="{{ route('sempro.create') }}" class="btn btn-primary float-end">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Sempro
                    </a>
                </div>
            </div>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Mahasiswa</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($sempro->count() > 0)
                    @foreach ($sempro as $sempro)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $sempro->pengajuan->judul }}</td>
                            <td class="align-middle">{{ $sempro->mahasiswa->nama }}</td>
                            <td class="align-middle">{{ $sempro->pengajuan->pembimbing1->nama ?? '-' }}</td>
                            <td class="align-middle">{{ $sempro->pengajuan->pembimbing2->nama ?? '-' }}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('sempro.show', $sempro->id_sempro) }}">
                                        <button class="btn btn-info" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    @can('isMahasiswa')
                                        <span style="margin: 0 4px;"></span>
                                        <a href="{{ route('sempro.edit', $sempro->id_sempro) }}">
                                            <button class="btn btn-warning" title="Edit Sempro">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    <span style="margin: 0 2px;"></span>
                                    @if (
                                        ($sempro->pengajuan->pembimbing1 &&
                                            auth()->user()->dosen &&
                                            auth()->user()->dosen->id_dosen === $sempro->pengajuan->pembimbing1->id_dosen) ||
                                            ($sempro->pengajuan->pembimbing2 &&
                                                auth()->user()->dosen &&
                                                auth()->user()->dosen->id_dosen === $sempro->pengajuan->pembimbing2->id_dosen) ||
                                            ($sempro->penguji && auth()->user()->dosen && auth()->user()->dosen->id_dosen === $sempro->penguji->id_dosen))
                                        <form action="/nilai_sempro/create{{ $sempro->id_nilai }}" method="GET"
                                            class="d-inline">
                                            <button type="submit" class="btn btn-primary mr-1">
                                                <i class="bi bi-bookmark-plus-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @can('isKaprodi')
                                        <span style="margin: 0 4px;"></span>
                                        <a href="{{ route('sempro.jadwal', $sempro->id_sempro) }}">
                                            <button class="btn btn-success" title="Jadwal Sempro">
                                                <i class="bi bi-clock"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    @can('isMahasiswa')
                                        <span style="margin: 0 4px;"></span>
                                        <form action="{{ route('sempro.destroy', $sempro->id_sempro) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus sempro ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="Hapus Sempro">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="align-middle text-center" colspan="10">Sempro tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

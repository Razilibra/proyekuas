@extends('admin.pages.home')


@section('content')
    <h1 class="title">
        <i class="bi bi-list-ul"></i> Data Sidang
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
        <div class="d-flex align-items-center">
            @can('isMahasiswa')
                <div class="col float-end" style="margin-right: 1rem;">
                    <a href="{{ route('sidang_ta.create') }}" class="btn btn-primary float-end">
                        <i class="bi bi-plus-circle-fill"></i> Daftar Sidang
                    </a>
                </div>
            @endcan
        </div>
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
                @if ($sidangta->count() > 0)
                    @foreach ($sidangta as $sidangta)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $sidangta->pengajuan->judul }}</td>
                            <td class="align-middle">{{ $sidangta->mahasiswa->nama }}</td>
                            <td class="align-middle">{{ $sidangta->pengajuan->pembimbing1->nama ?? '-' }}</td>
                            <td class="align-middle">{{ $sidangta->pengajuan->pembimbing2->nama ?? '-' }}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('sidang_ta.show', $sidangta->id_sidang) }}">
                                        <button class="btn btn-info" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    @can('isMahasiswa')
                                        <span style="margin: 0 4px;"></span>
                                        <a href="{{ route('sidang_ta.edit', $sidangta->id_sidang) }}">
                                            <button class="btn btn-warning" title="Edit Sidang">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    @can('isKaprodi')
                                        <span style="margin: 0 4px;"></span>
                                        <a href="{{ route('sidang_ta.jadwal', $sidangta->id_sidang) }}">
                                            <button class="btn btn-success" title="Jadwal Sidang">
                                                <i class="bi bi-clock"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    <span style="margin: 0 2px;"></span>
                                    @if (
                                        ($sidangta->pengajuan->pembimbing1 &&
                                            auth()->user()->dosen &&
                                            auth()->user()->dosen->id_dosen === $sidangta->pengajuan->pembimbing1->id_dosen) ||
                                            ($sidangta->pengajuan->pembimbing2 &&
                                                auth()->user()->dosen &&
                                                auth()->user()->dosen->id_dosen === $sidangta->pengajuan->pembimbing2->id_dosen) ||
                                            ($sidangta->penguji &&
                                                auth()->user()->dosen &&
                                                auth()->user()->dosen->id_dosen === $sidangta->penguji->id_dosen))
                                        <form action="/nilai_ta/create{{ $sidangta->id_nilai_ta }}" method="GET"
                                            class="d-inline">
                                            <button type="submit" class="btn btn-primary mr-1">
                                                <i class="bi bi-bookmark-plus-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @can('isMahasiswa')
                                        <span style="margin: 0 4px;"></span>
                                        <form action="{{ route('sidang_ta.destroy', $sidangta->id_sidang) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus sidang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="Hapus Sidang">
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
                        <td class="align-middle text-center" colspan="10">Sidang tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

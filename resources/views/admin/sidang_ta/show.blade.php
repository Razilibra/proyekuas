@extends('admin.pages.home')


@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-none text-dark">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Detail Sidang Tugas Akhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Judul Tugas Akhir</th>
                                <td>{{ $sidangta->pengajuan->judul ?? 'Tidak Ada Judul' }}</td>
                            </tr>
                            <tr>
                                <th>Mahasiswa</th>
                                <td>{{ $sidangta->mahasiswa->nama ?? 'Tidak Ada Nama' }}</td>
                            </tr>
                            <tr>
                                <th>Pembimbing 1</th>
                                <td>{{ $sidangta->pengajuan->pembimbing1->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pembimbing 2</th>
                                <td>{{ $sidangta->pengajuan->pembimbing2->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Ketua Sidang</th>
                                <td>{{ $sidangta->pengajuan->pembimbing1->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Sekretaris Sidang</th>
                                <td>{{ $sidangta->sekretaris_penguji->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Anggota 1</th>
                                <td>{{ $sidangta->anggota1->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Anggota 2</th>
                                <td>{{ $sidangta->anggota2->nama ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Ruangan Sidang</th>
                                <td>{{ $sidangta->ruangan->nama_ruangan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Sesi Sidang</th>
                                <td>{{ $sidangta->sesi->sesi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Sidang</th>
                                <td>{{ $sidangta->tgl_sidang ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Full Tugas Akhir</th>
                                <td>
                                    @if ($sidangta->full_ta)
                                        <a href="{{ Storage::url($sidangta->full_ta) }}"
                                            class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="bi bi-download"></i> Download File
                                        </a>
                                    @else
                                        <span class="text-danger">Tidak ada file TA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Bab 1</th>
                                <td>
                                    @if ($sidangta->bab_1)
                                        <a href="{{ Storage::url($sidangta->bab_1) }}"
                                            class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="bi bi-download"></i> Download File
                                        </a>
                                    @else
                                        <span class="text-danger">Tidak ada file Bab 1</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Poster</th>
                                <td>
                                    @if ($sidangta->poster)
                                        <a href="{{ Storage::url($sidangta->poster) }}"
                                            class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="bi bi-download"></i> Download Poster
                                        </a>
                                    @else
                                        <span class="text-danger">Tidak ada poster</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('sidang_ta.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>
@endsection

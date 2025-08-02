
@extends('admin.pages.home')

@section('title', 'Detail Data Mahasiswa PKL')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Mahasiswa PKL</h6>
        </div>
        <div class="card-body">
            <!-- Informasi Utama -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="text-center">Informasi Utama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th width="30%">Nama Mahasiswa</th>
                            <td>{{ $mahasiswaPkl->mahasiswa->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Judul PKL</th>
                            <td>{{ $mahasiswaPkl->judul ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tempat PKL</th>
                            <td>{{ $mahasiswaPkl->registrasi->tempatPkl->nama_perusahaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun PKL</th>
                            <td>{{ $mahasiswaPkl->tahun_pkl ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Informasi Sidang -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="text-center">Informasi Sidang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th width="30%">Ruangan Sidang</th>
                            <td>{{ $mahasiswaPkl->ruangan_sidang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Pembimbing</th>
                            <td>{{ $mahasiswaPkl->registrasi->pembimbing->nama ?? 'Belum Ada Pembimbing' }}</td>
                        </tr>
                        <tr>
                            <th>Sesi</th>
                            <td>
                                {{ $mahasiswaPkl->sesi ? $mahasiswaPkl->sesi->nama_sesi . ' (' . $mahasiswaPkl->sesi->jam_mulai . ' - ' . $mahasiswaPkl->sesi->jam_berakhir . ')' : '-' }}
                            </td>
                        </tr>


                        <tr>
                            <th>Dosen Penguji</th>
                            <td>{{ $mahasiswaPkl->dosenpenguji->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Pembimbing Pkl Industri</th>
                            <td>{{ $mahasiswaPkl->pembimbing_pkl ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Sidang</th>
                            <td>{{ $mahasiswaPkl->tanggal_sidang ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Nilai dan Rekomendasi -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="text-center">Nilai dan Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th width="30%">Nilai Dosen Pembimbing</th>
                            @if ($dosen_pembimbing)
                                <td>
                                    {{ $dosen_pembimbing->registrasi->nama ?? 'Nama tidak tersedia' }}
                                    ({{ $dosen_pembimbing->total_nilai ?? '-' }})
                                </td>
                            @else
                                <td colspan="1">Data penilaian untuk Dosen Pembimbing tidak tersedia.</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Nilai Penguji</th>
                            <td>{{ $dosen_penguji->total_nilai ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th>Nilai Pembimbing Industri</th>
                            <td>{{ $mahasiswaPkl->nilai_pembimbing_industri ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total Nilai Akhir</th>
                            <td>{{ $mahasiswaPkl->total_nilai_akhir ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Rekomendasi</th>
                            <td>{{ $mahasiswaPkl->rekomendasi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Informasi Detail</th>
                            <td>{{ $mahasiswaPkl->informasi_detail ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Dokumen -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="text-center">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th width="30%">Dokumen Nilai Industri</th>
                            <td>
                                @if($mahasiswaPkl->dokument_nilai_industri)
                                    <a href="{{ asset('storage/'.$mahasiswaPkl->dokument_nilai_industri) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-file-download"></i> Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen PKL</th>
                            <td>
                                @if($mahasiswaPkl->dokument_pkl)
                                    <a href="{{ asset('storage/'.$mahasiswaPkl->dokument_pkl) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-file-download"></i> Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen PKL Revisi</th>
                            <td>
                                @if($mahasiswaPkl->dokument_pkl_revisi)
                                    <a href="{{ asset('storage/'.$mahasiswaPkl->dokument_pkl_revisi) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-file-download"></i> Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen Kuisioner</th>
                            <td>
                                @if($mahasiswaPkl->dokument_kuisioner)
                                    <a href="{{ asset('storage/'.$mahasiswaPkl->dokument_kuisioner) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-file-download"></i> Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <a href="{{ route('mahasiswapkl.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

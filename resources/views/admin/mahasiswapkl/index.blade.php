
@extends('admin.pages.home')

@section('title', 'Data Mahasiswa PKL')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa PKL</h6>
            <div class="card-tools">
                <a href="{{ route('mahasiswapkl.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>

        </div>
                <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered  table-striped">
                    <thead  class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Judul PKL</th>
                            {{-- <th>Ruangan Sidang</th>
                            <th>Tempat PKL</th>
                            <th>Tahun PKL</th>
                            <th>Dosen Pembimbing</th>
                            <th>Dosen Penguji</th>
                            <th>Pembimbing PKL</th>
                            <th>Nilai Pembimbing Industri</th>
                            <th>Dokumen Nilai Industri</th>
                            <th>Dokumen PKL</th>
                            <th>Dokumen PKL Revisi</th>
                            <th>Dokumen Kuisioner</th>
                            <th>Tanggal Sidang</th>
                            <th>Rekomendasi</th>
                            <th>Informasi Detail</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa_pkl as $mahasiswaPkl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mahasiswaPkl->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $mahasiswaPkl->judul }}</td>
                           {{--  <td>{{ $mahasiswaPkl->ruangan_sidang }}</td>
                            <td>{{ $mahasiswaPkl->tempatPkl->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $mahasiswaPkl->tahun_pkl }}</td>
                            <td>{{ $mahasiswaPkl->dosen_pembimbing }}</td>
                            <td>{{ $mahasiswaPkl->dosen_penguji }}</td>
                            <td>{{ $mahasiswaPkl->pembimbing_pkl }}</td>
                            <td>{{ $mahasiswaPkl->nilai_pembimbing_industri }}</td>
                            <td>{{ $mahasiswaPkl->dokument_nilai_industri }}</td>
                            <td>{{ $mahasiswaPkl->dokument_pkl }}</td>
                            <td>{{ $mahasiswaPkl->dokument_pkl_revisi }}</td>
                            <td>{{ $mahasiswaPkl->dokument_kuisioner }}</td>
                            <td>{{ $mahasiswaPkl->tanggal_sidang }}</td>
                            <td>{{ $mahasiswaPkl->rekomendasi }}</td>
                            <td>{{ $mahasiswaPkl->informasi_detail }}</td> --}}
                            <td>

                                <div class="d-flex flex-wrap gap-2">

                                    {{-- Tombol Edit --}}
                                    {{-- <div class="btn-group" role="group">
                                        <a href="{{ route('mahasiswapkl.edit', $mahasiswaPkl->id_mahasiswa_pkl) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div> --}}

                                  
                                 

                                @canany(['isAdministrator', 'isKaprodi'])
                                @if(!$mahasiswaPkl->mahasiswa_logbook) {{-- Ganti dengan kondisi penilaian --}}
                                    <div class="btn-group" role="group">

                                        <a href="{{ url('/mahasiswapkllogbook') }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Log Book PKL">
                                            <i class="fas fa-folder"></i>
                                        </a>
                                    </div>
                                @endif
                            @endcanany



                                 

                                    @canany(['isAdministrator', 'isKaprodi'])
                                    {{-- Tombol Tentukan Jadwal --}}
                                    @if(!$mahasiswaPkl->jadwal_ditentukan) {{-- Ganti dengan kondisi jadwal --}}
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mahasiswapkl.jadwal', $mahasiswaPkl->id_mahasiswa_pkl) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Tentukan Jadwal">
                                                <i class="fas fa-calendar"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @endcanany

                                    @canany(['isAdministrator', 'isKaprodi', 'isDosen', 'isMahasiswa'])
                                    {{-- Tombol Lihat Detail --}}
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mahasiswapkl.show', $mahasiswaPkl->id_mahasiswa_pkl) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                    @endcanany
                                    @canany(['isAdministrator', 'isKaprodi'])
                                    {{-- Tombol Hapus --}}
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('mahasiswapkl.destroy', $mahasiswaPkl->id_mahasiswa_pkl) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endcanany

                                </div>


                            </td
                        </tr>
                        @empty
                        <tr>
                            <td colspan="18" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

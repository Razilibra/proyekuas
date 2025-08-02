@extends('admin.pages.home')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Profil Mahasiswa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if ($mahasiswa->foto)
                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                     class="img-fluid rounded-circle shadow-lg mb-3"
                                     style="width: 200px; height: 200px; object-fit: cover;"
                                     alt="Foto {{ $mahasiswa->nama }}">
                            @else
                                <div class="rounded-circle shadow-lg mx-auto mb-3"
                                     style="width: 200px; height: 200px; background: #e9ecef;
                                     display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user fa-5x text-secondary"></i>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="border-bottom pb-2 mb-4">Informasi Pribadi</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="w-25">Nama Lengkap</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIM</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Akses</th>
                                            <td class="font-weight-bold">{{ $mahasiswa->akses == 0 ? 'Mahasiswa' : 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Daftar</th>
                                            <td class="font-weight-bold">{{ \Carbon\Carbon::parse($mahasiswa->tanggal_daftar)->format('d M Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id_mahasiswa) }}" class="btn btn-warning mr-2">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

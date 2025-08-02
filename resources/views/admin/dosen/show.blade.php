@extends('admin.pages.home')

@section('title', 'Detail Dosen')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Profil Dosen</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if ($dosen->foto)
                                <img src="{{ asset('storage/' . $dosen->foto) }}"
                                     class="img-fluid rounded-circle shadow-lg mb-3"
                                     style="width: 200px; height: 200px; object-fit: cover;"
                                     alt="Foto {{ $dosen->nama }}">
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

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Nama Lengkap</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->nama }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">NIDN</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->nidn }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Jenis Kelamin</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->gender }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Tempat, Tanggal Lahir</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->tempat_lahir }}, {{ $dosen->tgl_lahir }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Pendidikan</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->pendidikan }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Jurusan</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->jurusan->nama_jurusan }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Program Studi</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->prodi->nama_prodi }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Pangkat</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->pangkat->pangkat }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Golongan</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->golongan->nama_golongan }}</p>
                                        </div>
                                    </div>

                                     <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Bidang</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->bidangs->bidang }}</p>
                                        </div>
                                    </div> 

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Jabatan</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->jabatan->jabatan_akademik }}</p>
                                        </div>
                                    </div>





                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Alamat</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->alamat }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Email</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->email }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">No HP</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->no_hp }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Sinta</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->sinta }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">link sinta</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->link_sinta }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Schoolar</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->schoolar }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="text-muted mb-0">Status</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="font-weight-bold mb-0">{{ $dosen->status }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('dosen.edit', $dosen->id_dosen) }}" class="btn btn-warning mr-2">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
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

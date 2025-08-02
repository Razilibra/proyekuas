@extends('admin.pages.home')

@section('title','Edit Dosen')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Dosen</h6>
                <a href="{{ route('dosen.index') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-arrow-left mr-2 "></i> Kembali
                </a>
            </div>

            <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nidn">NIDN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" value="{{ old('nidn', $dosen->nidn) }}">
                                @error('nidn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('gender', $dosen->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender', $dosen->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $dosen->tempat_lahir) }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $dosen->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pendidikan">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('pendidikan') is-invalid @enderror"
                                    id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $dosen->pendidikan) }}">
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_jurusan">Jurusan <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_jurusan') is-invalid @enderror" id="id_jurusan" name="id_jurusan">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan', $dosen->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                                            {{ $j->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_prodi">Program Studi <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_prodi') is-invalid @enderror" id="id_prodi" name="id_prodi">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($prodi as $p)
                                        <option value="{{ $p->id_prodi }}" {{ old('id_prodi', $dosen->id_prodi) == $p->id_prodi ? 'selected' : '' }}>
                                            {{ $p->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_jabatan">Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($jabatan as $jb)
                                        <option value="{{ $jb->id_jabatan }}" {{ old('id_jabatan', $dosen->id_jabatan) == $jb->id_jabatan ? 'selected' : '' }}>
                                            {{ $jb->jabatan_akademik }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_bidang">Bidang <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_bidang') is-invalid @enderror" id="id_bidang" name="id_bidang">
                                    <option value="">Pilih Bidang</option>
                                    @foreach($bidangs as $bd)
                                        <option value="{{ $bd->id_bidang }}" {{ old('id_bidang', $dosen->id_bidang) == $bd->id_bidang ? 'selected' : '' }}>
                                            {{ $bd->bidang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_bidang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_golongan">Golongan <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                    <option value="">Pilih Golongan</option>
                                    @foreach($golongan as $g)
                                        <option value="{{ $g->id_golongan }}" {{ old('id_golongan', $dosen->id_golongan) == $g->id_golongan ? 'selected' : '' }}>
                                            {{ $g->nama_golongan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_pangkat">Pangkat <span class="text-danger">*</span></label>
                                <select class="form-control @error('id_pangkat') is-invalid @enderror" id="id_pangkat" name="id_pangkat">
                                    <option value="">Pilih Pangkat</option>
                                    @foreach($pangkat as $pk)
                                        <option value="{{ $pk->id_pangkat }}" {{ old('id_pangkat', $dosen->id_pangkat) == $pk->id_pangkat ? 'selected' : '' }}>
                                            {{ $pk->pangkat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_pangkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" rows="3">{{ old('alamat', $dosen->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $dosen->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No. HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" value="{{ old('no_hp', $dosen->no_hp) }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sinta">Sinta <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sinta') is-invalid @enderror"
                                    id="sinta" name="sinta" value="{{ old('sinta', $dosen->sinta) }}">
                                @error('sinta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="link_sinta">Link Sinta <span class="text-danger">*</span></label>
                                <input type="url" class="form-control @error('link_sinta') is-invalid @enderror"
                                    id="link_sinta" name="link_sinta" value="{{ old('link_sinta', $dosen->link_sinta) }}">
                                @error('link_sinta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="Aktif" {{ old('status', $dosen->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non-Aktif" {{ old('status', $dosen->status) == '0' ? 'selected' : '' }}>Non-aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

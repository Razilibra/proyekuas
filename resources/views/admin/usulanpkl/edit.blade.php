
@extends('admin.pages.home')

@section('title', 'Edit Usulan PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Usulan PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('usulan_pkl.update', $usulan_pkl->id_usulan_pkl) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_mahasiswa" class="form-label">Mahasiswa</label>
                            <select class="form-control @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa">
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswa as $m)
                                    <option value="{{ $m->id_mahasiswa }}" {{ old('id_mahasiswa', $usulan_pkl->id_mahasiswa) == $m->id_mahasiswa ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_tempat_pkl" class="form-label">Tempat PKL</label>
                            <select class="form-control @error('id_tempat_pkl') is-invalid @enderror" id="id_tempat_pkl" name="id_tempat_pkl">
                                <option value="">Pilih Tempat PKL</option>
                                @foreach($tempat_pkl as $tempat_pkl)
                                    <option value="{{ $tempat_pkl->id_tempat_pkl }}" {{ old('id_tempat_pkl', $usulan_pkl->id_tempat_pkl) == $tempat_pkl->id_tempat_pkl ? 'selected' : '' }}>
                                        {{ $tempat_pkl->nama_perusahaan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tempat_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <select class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" name="tahun_ajaran" required>
                                <option value="">Pilih Tahun Ajaran</option>
                                @for ($i = 2019; $i <= 2035; $i++)
                                    <option value="{{ $i }}/{{ $i + 1 }}" {{ old('tahun_ajaran') == "{$i}/" . ($i + 1) ? 'selected' : '' }}>
                                        {{ $i }}/{{ $i + 1 }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="konfirmasi" class="form-label">Status Konfirmasi</label>
                            <select class="form-control @error('konfirmasi') is-invalid @enderror" id="konfirmasi" name="konfirmasi">
                                <option value="0" {{ old('konfirmasi', $usulan_pkl->tempatPkl->konfirmasi) == '0' ? 'selected' : '' }}>Belum Dikonfirmasi</option>
                                <option value="1" {{ old('konfirmasi', $usulan_pkl->tempatPkl->konfirmasi) == '1' ? 'selected' : '' }}>Dikonfirmasi</option>
                            </select>
                            @error('konfirmasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('usulan_pkl.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

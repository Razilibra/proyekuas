
@extends('admin.pages.home')
@section('title', 'Edit Registrasi PKL')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Registrasi PKL</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('registrasipkl.update', $registrasiPkl->id_registrasi_pkl) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $registrasiPkl->nama_perusahaan) }}">
                    @error('nama_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                    <textarea class="form-control @error('alamat_perusahaan') is-invalid @enderror" id="alamat_perusahaan" name="alamat_perusahaan" rows="3">{{ old('alamat_perusahaan', $registrasiPkl->alamat_perusahaan) }}</textarea>
                    @error('alamat_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">File Pendukung</label>
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
                    @if($registrasiPkl->file)
                        <small class="form-text text-muted">File saat ini: {{ $registrasiPkl->file }}</small>
                    @endif
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pembimbing_id">Dosen Pembimbing</label>
                    <select class="form-control @error('pembimbing_id') is-invalid @enderror" id="pembimbing_id" name="pembimbing_id">
                        <option value="">Pilih Dosen Pembimbing</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id_dosen }}" {{ old('pembimbing_id', $registrasiPkl->pembimbing_id) == $d->id_dosen ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pembimbing_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('registrasipkl.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

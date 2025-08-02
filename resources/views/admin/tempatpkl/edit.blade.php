@extends('admin.pages.home')

@section('title', 'Edit Tempat PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Tempat PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('tempat_pkl.update', $tempatPkl->id_tempat_pkl) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $tempatPkl->nama_perusahaan) }}">
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat_perusahaan" class="form-label">Alamat PKL</label>
                            <textarea class="form-control @error('alamat_perusahaan') is-invalid @enderror" id="alamat_perusahaan" name="alamat_perusahaan" rows="3">{{ old('alamat_perusahaan', $tempatPkl->alamat_perusahaan) }}</textarea>
                            @error('alamat_perusahaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota" name="kuota" value="{{ old('kuota', $tempatPkl->kuota) }}" min="1">
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', $tempatPkl->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', $tempatPkl->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('tempat_pkl.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.pages.home')

@section('title', 'Tambah Jenjang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenjang.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama Jenjang</label>
                            <select class="form-control @error('nama_jenjang') is-invalid @enderror" name="nama_jenjang">
                                <option value="">Pilih Jenjang</option>
                                <option value="D2" {{ old('nama_jenjang') == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ old('nama_jenjang') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ old('nama_jenjang') == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S2" {{ old('nama_jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                            @error('nama_jenjang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jenjang.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

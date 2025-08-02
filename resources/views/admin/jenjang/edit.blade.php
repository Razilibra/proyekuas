@extends('admin.pages.home')

@section('title', 'Edit Jenjang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenjang.update', $jenjang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Jenjang</label>
                            <input type="text" class="form-control @error('nama_jenjang') is-invalid @enderror"
                                name="nama_jenjang" value="{{ old('nama_jenjang', $jenjang->nama_jenjang) }}">
                            @error('nama_jenjang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $jenjang->keterangan) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('jenjang.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

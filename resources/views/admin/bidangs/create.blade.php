
@extends('admin.pages.home')

@section('title', 'Tambah Bidang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Bidang</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('bidang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="bidang" class="form-label"> Bidang </label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" id="bidang" name="bidang" value="{{ old('bidang') }}" required>
                            @error('bidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('bidang.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

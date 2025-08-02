@extends('admin.pages.home')

@section('title','Edit Pangkat')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Pangkat</h6>
            </div>

            <form action="{{ route('pangkat.update', $pangkat->id_pangkat) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="pangkat">Nama Pangkat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pangkat') is-invalid @enderror" 
                            id="pangkat" name="pangkat" value="{{ old('pangkat', $pangkat->pangkat) }}">
                        @error('pangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pangkat.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
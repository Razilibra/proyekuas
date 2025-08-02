@extends('admin.pages.home')

@section('title','Daftar Prodi')

@section('content')
<div class="container">
    <h2>Edit Prodi</h2>
    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_prodi">Prodi</label>
            <input type="text" name="nama_prodi" class="form-control" value="{{ $prodi->nama_prodi }}" required>
        </div>
        <div class="form-group">
            <label for="jenjang">Jenjang</label>
            <input type="text" name="jenjang" class="form-control" value="{{ $prodi->jenjang }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

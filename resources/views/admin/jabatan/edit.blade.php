@extends('admin.pages.home')

@section('title','Daftar jabatan')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Jabatan</h1>

    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="jabatan_akademik">Jabatan Akademik:</label>
            <input type="text" id="jabatan_akademik" name="jabatan_akademik" class="form-control" value="{{ $jabatan->jabatan_akademik }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
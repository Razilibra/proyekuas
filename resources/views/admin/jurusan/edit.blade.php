@extends('admin.pages.home')

@section('title', 'Edit Jurusan')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h3 class="text-center">Edit Jurusan</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada masalah dengan inputan Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_jurusan">Kode Jurusan:</label>
                    <input type="text" name="kode_jurusan" class="form-control" value="{{ $jurusan->kode_jurusan }}" placeholder="Kode Jurusan">
                </div>
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan:</label>
                    <input type="text" name="nama_jurusan" class="form-control" value="{{ $jurusan->nama_jurusan }}" placeholder="Nama Jurusan">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $jurusan->keterangan }}</textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

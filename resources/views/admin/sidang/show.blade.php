@extends('admin.pages.home')

@section('title', 'Detail Sidang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail Sidang</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Tanggal:</strong>
                <p>{{ $sidang->tanggal }}</p>
            </div>

            <div class="mb-3">
                <strong>Sesi:</strong>
                <p>{{ $sidang->sesi->nama_sesi }}</p>
            </div>

            <div class="mb-3">
                <strong>Ruangan:</strong>
                <p>{{ $sidang->ruangan->nama_ruangan }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('sidangs.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('sidangs.edit', $sidang->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('sidangs.destroy', $sidang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

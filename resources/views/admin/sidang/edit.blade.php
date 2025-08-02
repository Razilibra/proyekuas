@extends('admin.pages.home')

@section('title', 'Edit Sidang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Edit Data Sidang</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang.update', $sidang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $sidang->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label for="id_sesi" class="form-label">Sesi</label>
                    <select name="id_sesi" class="form-control" required>
                        <option value="">Pilih Sesi</option>
                        @foreach ($sesi as $s)
                            <option value="{{ $s->id }}" {{ old('id_sesi') == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_sesi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_ruangan" class="form-label">Ruangan</label>
                    <select name="id_ruangan" class="form-control" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangan as $r)
                            <option value="{{ $r->id }}" {{ old('id_ruangan') == $r->id ? 'selected' : '' }}>
                                {{ $r->nama_ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('sidang.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

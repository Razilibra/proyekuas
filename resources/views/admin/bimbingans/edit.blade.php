
@extends('admin.pages.home')

@section('title', 'Edit Bimbingan')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Bimbingan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bimbingans.update', $bimbingan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="mahasiswa_id">Mahasiswa</label>
                            <select class="form-control @error('mahasiswa_id') is-invalid @enderror" name="mahasiswa_id" id="mahasiswa_id">
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id', $bimbingan->mahasiswa_id) == $mahasiswa->id ? 'selected' : '' }}>
                                        {{ $mahasiswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mahasiswa_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dosen_id">Dosen Pembimbing</label>
                            <select class="form-control @error('dosen_id') is-invalid @enderror" name="dosen_id" id="dosen_id">
                                <option value="">Pilih Dosen</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id', $bimbingan->dosen_id) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $bimbingan->judul) }}">
                            @error('judul')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $bimbingan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                <option value="pending" {{ old('status', $bimbingan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $bimbingan->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $bimbingan->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.bimbingans.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

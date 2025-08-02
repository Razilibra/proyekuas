@extends('admin.pages.home')

@section('title', 'Edit Penilaian PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Penilaian PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilaipkl.update', $nilaipkl->id_nilaipkl) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_dosen">Dosen</label>
                            <select name="id_dosen" class="form-control">
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $nilaipkl->id_dosen ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_mahasiswa_pkl">Mahasiswa PKL</label>
                            <select name="id_mahasiswa_pkl" class="form-control">
                                @foreach ($mahasiswaPkls as $mahasiswaPkl)
                                    <option value="{{ $mahasiswaPkl->id_mahasiswa_pkl }}" {{ $mahasiswaPkl->id_mahasiswa_pkl == $nilaipkl->id_mahasiswa_pkl ? 'selected' : '' }}>{{ $mahasiswaPkl->mahasiswa->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keaktifan_bimbingan">Keaktifan Bimbingan</label>
                            <input type="number" name="keaktifan_bimbingan" class="form-control" value="{{ $nilaipkl->keaktifan_bimbingan }}" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label for="komunikatif">Komunikatif</label>
                            <input type="number" name="komunikatif" class="form-control" value="{{ $nilaipkl->komunikatif }}" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label for="problem_solving">Problem Solving</label>
                            <input type="number" name="problem_solving" class="form-control" value="{{ $nilaipkl->problem_solving }}" min="0" max="100">
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('nilaipkl.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

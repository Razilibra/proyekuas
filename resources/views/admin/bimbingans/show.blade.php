
@extends('admin.pages.home')


@section('title', 'Detail Bimbingan')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Bimbingan</h3>
            <div class="float-right">
                <a href="{{ route('admin.bimbingans.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Mahasiswa</th>
                            <td>{{ $bimbingan->mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Pembimbing</th>
                            <td>{{ $bimbingan->dosen->nama }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $bimbingan->judul }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $bimbingan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>File</th>
                            <td>
                                @if($bimbingan->file)
                                    <a href="{{ asset('storage/' . $bimbingan->file) }}" target="_blank" class="btn btn-info btn-sm">
                                        Download File
                                    </a>
                                @else
                                    Tidak ada file
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($bimbingan->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($bimbingan->status == 'approved')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($bimbingan->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ $bimbingan->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($bimbingan->status == 'pending')
            <div class="row mt-4">
                <div class="col-md-6">
                    <form action="{{ route('admin.bimbingans.update', $bimbingan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Update Status</label>
                            <select name="status" class="form-control">
                                <option value="approved">Setujui</option>
                                <option value="rejected">Tolak</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

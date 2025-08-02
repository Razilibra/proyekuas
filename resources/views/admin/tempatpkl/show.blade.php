
@extends('admin.pages.home')

@section('title', 'Detail Tempat PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Tempat PKL</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Nama Perusahaan</th>
                                <td>{{ $tempatPkl->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Info PKL</th>
                                <td>{{ $tempatPkl->alamat_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Kuota</th>
                                <td>{{ $tempatPkl->kuota }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($tempatPkl->status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ route('tempat_pkl.index') }}" class="btn btn-secondary me-md-2">Kembali</a>
                        <a href="{{ route('tempat_pkl.edit', $tempatPkl->id_tempat_pkl) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tempat_pkl.destroy', $tempatPkl->id_tempat_pkl) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('admin.pages.home')

@section('title', 'Detail Usulan PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Usulan PKL</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Mahasiswa</th>
                                <td>{{ $usulanPkl->mahasiswa->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tempat PKL</th>
                                <td>{{ $usulanPkl->tempatPkl->lokasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Ajaran</th>
                                <td>{{ $usulanPkl->tahun_ajaran }}</td>
                            </tr>
                            <tr>
                                <th>Status Konfirmasi</th>
                                <td>
                                    @if ($usulanPkl->konfirmasi == '1')
                                        <span class="badge bg-success">Dikonfirmasi</span>
                                    @else
                                        <span class="badge bg-danger">Belum Dikonfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ route('usulan_pkl.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('usulan_pkl.edit', $usulanPkl->id_usulan_pkl) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('usulan_pkl.destroy', $usulanPkl->id_usulan_pkl) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

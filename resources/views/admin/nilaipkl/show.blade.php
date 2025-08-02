@extends('admin.pages.home')

@section('title', 'Detail Penilaian PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Penilaian PKL</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" colspan="2">Form Penilaian Bimbingan PKL</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th class="bg-primary text-white" style="width: 35%;">ID Penilaian</th>
                                    <td>{{ $nilaipkl->id_nilai_pkl }}</td>
                                </tr> --}}
                                <tr>
                                    <th class="text-black">Nama Dosen</th>
                                    <td>{{ $nilaipkl->dosen->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-black">Nama Mahasiswa PKL</th>
                                    <td>{{ $nilaipkl->mahasiswaPkl->mahasiswa->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-black">Keaktifan Bimbingan</th>
                                    <td>{{ $nilaipkl->keaktifan_bimbingan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-black">Komunikatif</th>
                                    <td>{{ $nilaipkl->komunikatif }}</td>
                                </tr>
                                <tr>
                                    <th class="text-black">Problem Solving</th>
                                    <td>{{ $nilaipkl->problem_solving }}</td>
                                </tr>
                                <tr>
                                    <th class="text-black">Total Nilai</th>
                                    <td>
                                        <span class="badge badge-success">{{ $nilaipkl->total_nilai }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-black">Keterangan</th>
                                    <td>
                                        @if ($nilaipkl->total_nilai >= 65)
                                            <span class="badge badge-success">Lulus</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Lulus</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('nilaipkl.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

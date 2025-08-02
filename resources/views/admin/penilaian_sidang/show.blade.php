@extends('admin.pages.home')

@section('title', 'Detail Penilaian Sidang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Detail Penilaian Sidang
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Mahasiswa PKL</th>
                                <td>{{ $penilaianSidang->mahasiswaPkl->mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dosen</th>
                                <td>{{ $penilaianSidang->dosen->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Posisi</th>
                                <td>{{ $penilaianSidang->posisi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Bahasa dan Tata Tulis Laporan</th>
                                <td>{{ $penilaianSidang->bahasa }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Analisis Masalah</th>
                                <td>{{ $penilaianSidang->analisis }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nilai Sikap</th>
                                <td>{{ $penilaianSidang->sikap }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Komunikasi</th>
                                <td>{{ $penilaianSidang->komunikasi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sistematika Penyajian</th>
                                <td>{{ $penilaianSidang->penyajian }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Penguasaan Materi</th>
                                <td>{{ $penilaianSidang->penguasaan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Nilai</th>
                                <td>{{ $penilaianSidang->total_nilai }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.pages.home')

@section('title', 'Detail Registrasi PKL')

@section('content')

<!-- Add Bootstrap 4 and FontAwesome CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-fluid">
    <!-- Title Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Registrasi PKL</h1>
    </div>

    <!-- Registrasi PKL Information Card -->
    <div class="card mb-4">
        <div class="card-header">
            Informasi Registrasi PKL
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $registrasi_pkl->mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $registrasi_pkl->mahasiswa->nim }}</td>
                </tr>
                <tr>
                    <th>Nama Perusahaan</th>
                    <td>{{ $registrasi_pkl->tempatPkl->nama_perusahaan }}</td>
                </tr>
                <tr>
                    <th>Alamat Perusahaan</th>
                    <td>{{ $registrasi_pkl->alamat_perusahaan }}</td>
                </tr>
                <tr>
                    <th>File Pendukung</th>
                    <td>
                        @if($registrasi_pkl->file)
                            <a href="{{ asset('storage/' . $registrasi_pkl->file) }}" target="_blank">Unduh File</a>
                        @else
                            <span class="text-muted">Tidak ada file</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing</th>
                    <td>{{ $registrasi_pkl->pembimbing->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Konfirmasi</th>
                    <td>
                        @if($registrasi_pkl->konfirmasi === '1')
                            <span class="text-success">Sudah Dikonfirmasi</span>
                        @else
                            <span class="text-danger">Belum Dikonfirmasi</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card">
        <div class="card-header">
            Aksi
        </div>
        <div class="card-body d-flex justify-content-start">
            <!-- Confirmation Action -->
            @canany(['isAdministrator', 'isSuperAdmin', 'isKaprodi'])
                @if($registrasi_pkl->konfirmasi !== '1')
                    <form action="{{ route('registrasi_pkl.acc', $registrasi_pkl->id_registrasi_pkl) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm mr-2" onclick="return confirm('Apakah Anda yakin ingin meng-ACC data ini?')">
                            <i class="fas fa-check"></i> ACC
                        </button>
                    </form>
                @endif
            @endcanany

            <!-- Assign Pembimbing Action -->
            @canany(['isAdministrator', 'isKaprodi'])
                @if($registrasi_pkl->konfirmasi === '1' && is_null($registrasi_pkl->pembimbing))
                    <a href="{{ route('registrasipkl.pembimbing', $registrasi_pkl) }}" class="btn btn-warning btn-sm mr-2">
                        <i class="fas fa-book"></i> Tentukan Pembimbing
                    </a>
                @endif
            @endcanany

            <!-- Back Button -->
            <a href="{{ route('registrasipkl.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<!-- Add Bootstrap and FontAwesome JS CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection

@extends('admin.pages.home')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <strong>Detail Seminar Proposal</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Judul Tugas Akhir</th>
                        <td>{{ $sempro->pengajuan->judul }}</td>
                    </tr>
                    <tr>
                        <th>Mahasiswa</th>
                        <td>{{ $sempro->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Pembimbing 1</th>
                        <td>{{ $sempro->pengajuan->pembimbing1->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pembimbing 2</th>
                        <td>{{ $sempro->pengajuan->pembimbing2->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Penguji Sempro</th>
                        <td>{{ $sempro->penguji->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Proposal Tugas Akhir</th>
                        <td>
                            @if ($sempro->file_sempro)
                                <a href="{{ Storage::url($sempro->file_sempro) }}">
                                    <button class="btn text-decoration-none text-dark" target="_blank"
                                        style="
                                            background-color: #fff;
                                            color: #007bff;
                                            padding: 10px 20px;
                                            border-radius: 5px;
                                            font-size: 12px;
                                            transition: all 0.3s ease;
                                            cursor: pointer;
                                            border: none;"
                                        onmouseover="this.style.backgroundColor='rgba(0, 123, 255, 0.1)'; this.style.color='#0056b3';"
                                        onmouseout="this.style.backgroundColor='#fff'; this.style.color='#007bff';"
                                        onmousedown="this.style.backgroundColor='rgba(0, 123, 255, 0.2)'; this.style.transform='scale(0.97)';"
                                        onmouseup="this.style.backgroundColor='rgba(0, 123, 255, 0.1)'; this.style.transform='scale(1)';">
                                        <i class="bi bi-download"></i> Download Proposal
                                    </button>
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file proposal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ruangan</th>
                        <td>{{ $sempro->ruangan->nama_ruangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Seminar</th>
                        <td>{{ $sempro->tgl_seminar ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('sempro.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection

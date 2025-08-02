@extends('admin.pages.home')

@section('title', 'Detail Pengajuan')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th colspan="3">Detail Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @if ($pengajuan)
                    <tr>
                        <td>Judul</td>
                        <td>{{ $pengajuan->judul }}</td>
                    </tr>
                    <tr>
                        <td>Nama Mahasiswa</td>
                        <td>{{ $pengajuan->mahasiswapengajuan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Bidang</td>
                        <td>{{ $pengajuan->bidangpengajuan->bidang }}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing 1</td>
                        <td>{{ $pengajuan->pembimbing1->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing 2</td>
                        <td>{{ $pengajuan->pembimbing2->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Dokumen Proposal TA</td>
                        <td>
                            @if ($pengajuan->proposal_tugas_akhir)
                                <a href="{{ Storage::url($pengajuan->proposal_tugas_akhir) }}" class="btn btn-primary btn-sm"
                                    target="_blank" title="Download Dokumen"><i class="bi bi-download"></i>
                                    Proposal TA
                                </a>
                            @else
                                Tidak ada dokumen proposal
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($pengajuan->acc_pembimbing1 == 'Disetujui' && $pengajuan->acc_pembimbing2 == 'Disetujui')
                                Disetujui
                            @else
                                Usulan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Acc Pembimbing 1</th>
                        <td>{{ $pengajuan->acc_pembimbing1 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Acc Pembimbing 2</th>
                        <td>{{ $pengajuan->acc_pembimbing2 ?? '-' }}</td>
                    </tr>

                @endif
            </tbody>
        </table>
        <a href="/pengajuan" class="btn btn-primary float-end">Kembali</a>

        </form>
    </div>

    {{-- @php
        $user = Auth::user();
        $isDosen = $user->dosen;

        $canApprovePembimbing1 =
            $pengajuan->acc_pembimbing1 !== 'Disetujui' &&
            $isDosen &&
            $user->dosen->id_dosen === $pengajuan->pembimbing1->id_dosen;

        $canApprovePembimbing2 =
            $pengajuan->acc_pembimbing2 !== 'Disetujui' &&
            $isDosen &&
            $user->dosen->id_dosen === $pengajuan->pembimbing2->id_dosen;
    @endphp

    @if ($canApprovePembimbing1) --}}
    <form action="{{ route('pengajuan.accPembimbing1', $pengajuan->id_tugasakhir) }}" method="POST" class="d-inline-block"
        onsubmit="return confirm('Apakah Anda yakin ingin menyetujui Pembimbing 1?');">
        @csrf
        <button type="submit" class="btn btn-success mt-3">Acc Pembimbing 1</button>
    </form>
    {{-- @endif

    @if ($canApprovePembimbing2) --}}
    <form action="{{ route('pengajuan.accPembimbing2', $pengajuan->id_tugasakhir) }}" method="POST" class="d-inline-block"
        onsubmit="return confirm('Apakah Anda yakin ingin menyetujui Pembimbing 2?');">
        @csrf
        <button type="submit" class="btn btn-success mt-3">Acc Pembimbing 2</button>
    </form>
    {{--  @endif --}}
@endsection

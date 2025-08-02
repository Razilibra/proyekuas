@extends('admin.pages.home')


@section('content')
    <h1 class="title">
        <i class="bi bi-plus-circle-fill"></i> Jadwalkan Sidang
    </h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle-fill"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sidang_ta.jadwal', $sidangta->id_sidang) }}">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="sekretaris" class="form-label">Sekretaris Sidang</label>
            <select name="sekretaris" id="sekretaris" class="form-select" required>
                <option value="">-- Pilih Sekretaris --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
            @error('sekretaris')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="anggota_1" class="form-label">Anggota 1 Penguji Sidang</label>
            <select name="anggota_1" id="anggota_1" class="form-select" required>
                <option value="">-- Pilih Penguji --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
            @error('anggota_1')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="anggota_2" class="form-label">Anggota 2 Penguji Sidang</label>
            <select name="anggota_2" id="anggota_2" class="form-select" required>
                <option value="">-- Pilih Penguji --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
            @error('anggota_2')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id_sesi" class="form-label">sesi</label>
            <select name="id_sesi" id="id_sesi" class="form-select" required>
                <option value="">-- Pilih sesi --</option>
                @foreach ($sesi as $sesi)
                    <option value="{{ $sesi->id_sesi }}">{{ $sesi->sesi }}</option>
                @endforeach
            </select>
            @error('id_ruangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select name="id_ruangan" id="id_ruangan" class="form-select" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
            @error('id_ruangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="tgl_sidang" class="form-label">Tanggal sidang</label>
            <input type="date" class="form-control" id="tgl_sidang" name="tgl_sidang">
            @error('tgl_sidang')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 row">
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@extends('admin.pages.home')

@section('title', 'Tambah Jadwal Sidang PKL')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Jadwal Sidang PKL</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('mahasiswapkl.storejadwal') }}" method="POST">
                @csrf

                <!-- Hidden Input untuk ID Mahasiswa PKL -->
                <input type="hidden" name="id_mahasiswa_pkl" value="{{ $mahasiswaPkl->id_mahasiswa_pkl }}">

                <!-- Dropdown Dosen Penguji -->
                <div class="form-group">
                    <label for="dosen_penguji" class="form-label">
                        Pilih Dosen Penguji <span class="text-danger">*</span>
                    </label>
                    <select
                        class="form-control @error('dosen_penguji') is-invalid @enderror"
                        id="dosen_penguji"
                        name="dosen_penguji"
                        required
                        aria-required="true"
                    >
                        <option value="" disabled {{ old('dosen_penguji') ? '' : 'selected' }}>
                            Pilih Dosen Penguji
                        </option>
                        @foreach ($dosen as $d)
                            <option value="{{ $d->id_dosen }}" {{ old('dosen_penguji') == $d->id_dosen ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dosen_penguji')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Dropdown Sesi -->
                <div class="form-group">
                    <label for="id_sesi" class="form-label">
                        Pilih Sesi <span class="text-danger">*</span>
                    </label>
                    <select
                        class="form-control @error('id_sesi') is-invalid @enderror"
                        id="id_sesi"
                        name="id_sesi"
                        required
                        aria-required="true"
                    >
                        <option value="" disabled {{ old('id_sesi') ? '' : 'selected' }}>
                            Pilih Sesi
                        </option>
                        @foreach ($sesi as $s)
                            <option value="{{ $s->id_sesi }}" {{ old('id_sesi') == $s->id_sesi ? 'selected' : '' }}>
                                {{ $s->nama_sesi }} ({{ $s->jam_mulai }} - {{ $s->jam_berakhir }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_sesi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Ruangan Sidang -->
                <div class="form-group">
                    <label for="ruangan_sidang">Ruangan Sidang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('ruangan_sidang') is-invalid @enderror" id="ruangan_sidang" name="ruangan_sidang" value="{{ old('ruangan_sidang') }}" required>
                    @error('ruangan_sidang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tanggal Sidang -->
                <div class="form-group">
                    <label for="tanggal_sidang">Tanggal Sidang</label>
                    <input type="date" class="form-control @error('tanggal_sidang') is-invalid @enderror" id="tanggal_sidang" name="tanggal_sidang" value="{{ old('tanggal_sidang') }}">
                    @error('tanggal_sidang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mahasiswapkl.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection

@extends('admin.pages.home')


@section('title', 'Tambah Nilai Tugas Akhir')

@section('content')
<h1 class="title mb-4">
    <i class="bi bi-plus-circle-fill"></i> Tambah Nilai
</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('nilai_ta.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="id_pengajuan" class="form-label">Judul Tugas Akhir</label>
        <select class="form-select form-select-lg shadow-none" id="id_pengajuan" name="id_pengajuan" required>
            <option value="" disabled {{ old('id_pengajuan') ? '' : 'selected' }}>Pilih Judul</option>
            @foreach ($pengajuans as $item)
                <option value="{{ $item->id_tugasakhir }}" {{ old('id_pengajuan') == $item->id_tugasakhir ? 'selected' : '' }}>
                    {{ $item->judul }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_dosen" class="form-label">Dosen</label>
        <select name="id_dosen" id="id_dosen" class="form-select" required>
            <option value="" disabled {{ old('id_dosen') ? '' : 'selected' }}>-- Pilih Dosen --</option>
            @foreach ($dosens as $dosen)
            <option value="{{ $dosen->id_dosen }}" {{ old('id_dosen') == $dosen->id_dosen ? 'selected' : '' }}>
                {{ $dosen->nama }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="jabatan_sidang" class="form-label">Jabatan Sidang</label>
        <select class="form-select" name="jabatan_sidang" id="jabatan_sidang" required>
            <option value="">--Pilih Jabatan</option>
            <option value="ketua_sidang"{{ old('jabatan_sidang') == 'ketua_sidang' ? 'selected' : '' }}>Ketua Sidang</option>
            <option value="sekretaris" {{ old('jabatan_sidang') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
            <option value="anggota1" {{ old('jabatan_sidang') == 'anggota_1' ? 'selected' : '' }}>Anggota 1</option>
            <option value="anggota2" {{ old('jabatan_sidang') == 'anggota_2' ? 'selected' : '' }}>anggota 2</option>
            <option value="pembimbing1" {{ old('jabatan_sidang') == 'pembimbing1' ? 'selected' : '' }}>Pembimbing 1</option>
            <option value="pembimbing2" {{ old('jabatan_sidang') == 'pembimbing2' ? 'selected' : '' }}>Pembimbing 2</option>
            <option value="penguji_sempro" {{ old('jabatan_sidang') == 'penguji_sempro' ? 'selected' : '' }}>Penguji Sempro</option>
        </select>
    </div>

    <h4 class="mt-4"><b>Bimbingan</b></h4>
    @foreach (['sikap_dan_penampilan', 'komunikasi_dan_sistematika', 'penguasaan_materi'] as $field)
    <div class="mb-3">
        <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
        <input type="number" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
    </div>
    @endforeach

    <h4 class="mt-4"><b>Makalah</b></h4>
    @foreach (['identifikasi_masalah_tujuan_dan_kontribusi_penelitian', 'relevansi_teori', 'metode_yang_digunakan', 'hasil_dan_pembahasan', 'penggunaan_bahasa_dan_tata_tulis','kesimpulan_dan_saran'] as $field)
    <div class="mb-3">
        <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
        <input type="number" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
    </div>
    @endforeach

    <h4 class="mt-4"><b>Produk</b></h4>
    @foreach (['kesesuaian_fungsionalitas_sistem'] as $field)
    <div class="mb-3">
        <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
        <input type="number" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
    </div>
    @endforeach

    <div class="mb-3">
        <label for="revisi" class="form-label">Revisi</label>
        <textarea class="form-control" id="revisi" name="revisi" rows="3" required>{{ old('revisi') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="total_nilai" class="form-label">Total Nilai</label>
        <input type="text" class="form-control @error('total_nilai') is-invalid @enderror" id="total_nilai" name="total_nilai" value="{{ old('total_nilai') }}" readonly>
        @error('total_nilai')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
    function hitungRataRata() {
        const fields = [
            'sikap_dan_penampilan', 'komunikasi_dan_sistematika', 'penguasaan_materi',
            'identifikasi_masalah_tujuan_dan_kontribusi_penelitian', 'relevansi_teori', 'metode_yang_digunakan',
            'hasil_dan_pembahasan', 'penggunaan_bahasa_dan_tata_tulis', 'kesimpulan_dan_saran', 'kesesuaian_fungsionalitas_sistem',
        ];

        let total = 0;
        let count = 0;

        fields.forEach(id => {
            const value = parseFloat(document.getElementById(id).value) || 0;
            if (value > 0) {
                total += value;
                count++;
            }
        });

        const rataRata = count > 0 ? total / count : 0;
        document.getElementById('total_nilai').value = rataRata.toFixed(2);
    }

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', hitungRataRata);
    });
</script>
@endsection

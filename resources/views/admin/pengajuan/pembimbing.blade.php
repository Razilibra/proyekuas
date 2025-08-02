@extends('admin.pages.home')
@section('title', 'Tentukan Pembimbing')


@section('content')
    <h1 class="title">
        <i class="bi bi-plus-circle-fill"></i> Tentukan Pembimbing
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

    <form action="{{ route('pengajuan.tentukanPembimbing', $pengajuan->id_tugasakhir) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kelompok_penelitian" class="form-label">Kelompok Penelitian</label>
            <select class="form-control" name="kelompok_penelitian" id="kelompok_penelitian" required>
                <option value="Web Programming"
                    {{ old('kelompok_penelitian', $pengajuan->kelompok_penelitian) == 'Web Programming' ? 'selected' : '' }}>
                    Web Programming</option>
                <option value="Data Science"
                    {{ old('kelompok_penelitian', $pengajuan->kelompok_penelitian) == 'Data Science' ? 'selected' : '' }}>
                    Data Science</option>
                <option value="Alat"
                    {{ old('kelompok_penelitian', $pengajuan->kelompok_penelitian) == 'Alat' ? 'selected' : '' }}>Alat
                </option>
                <option value="Mobile Programming"
                    {{ old('kelompok_penelitian', $pengajuan->kelompok_penelitian) == 'Mobile Programming' ? 'selected' : '' }}>
                    Mobile Programming</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="bidang" class="form-label">Bidang Keahlian</label>
            <select class="form-control" name="bidang" id="bidang" required>
                <option value="">Pilih Bidang Keahlian</option>
                @foreach ($bidangs as $bidang)
                    <option value="{{ $bidang->id_bidang }}"
                        {{ old('bidang', $pengajuan->bidang) == $bidang->id_bidang ? 'selected' : '' }}>
                        {{ $bidang->bidang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pembimbing_1" class="form-label">Pembimbing 1 <span class="text-danger">*</span></label>
            <select class="form-control" id="pembimbing_1" name="pembimbing_1" required>
                <option value="">Pilih Pembimbing 1</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}"
                        {{ old('pembimbing_1', $pengajuan->pembimbing_1) == $dosen->nama ? 'selected' : '' }}>
                        {{ $dosen->nama }}</option>
                @endforeach
                @error('pembimbing_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </select>
            @error('pembimbing_1')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pembimbing_2" class="form-label">Pembimbing 2 <span class="text-muted">(Opsional)</span></label>
            <select class="form-control" id="pembimbing_2" name="pembimbing_2">
                <option value="">Pilih Pembimbing 2</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}"
                        {{ old('pembimbing_2', $pengajuan->pembimbing_2) == $dosen->nama ? 'selected' : '' }}>
                        {{ $dosen->nama }}</option>
                @endforeach
                @error('pembimbing_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </select>
            @error('pembimbing_2')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-control" name="status" id="status" required>
                <option value="">Pilih Status</option>
                <option value="Terima" {{ old('status', $pengajuan->status) == 'Terima' ? 'selected' : '' }}>Terima
                </option>
                <option value="Perbaikan" {{ old('status', $pengajuan->status) == 'Perbaikan' ? 'selected' : '' }}>
                    Perbaikan</option>
                <option value="Tolak" {{ old('status', $pengajuan->status) == 'Tolak' ? 'selected' : '' }}>Tolak</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#bidang').change(function() {
            var bidangId = $(this).val();
            console.log('Bidang ID yang dipilih: ', bidangId); // Debugging log

            if (bidangId) {
                $.ajax({
                    url: '/pengajuans/getdosen/' + bidangId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#pembimbing_1, #pembimbing_2').empty();
                        $('#pembimbing_1, #pembimbing_2').append(
                            '<option value="">Pilih Dosen</option>'); // Tambahkan opsi default
                        $.each(data, function(key, value) {
                            $('#pembimbing_1, #pembimbing_2').append('<option value="' + value
                                .id_dosen + '">' + value.nama + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error("Kesalahan AJAX:", xhr.responseText);
                        alert('Terjadi kesalahan saat mengambil data dosen: ' + xhr.responseText);
                    }
                });
            } else {
                $('#pembimbing_1, #pembimbing_2').empty();
                $('#pembimbing_1, #pembimbing_2').append('<option value="">Pilih Dosen</option>');
            }
        });
    </script>
@endsection

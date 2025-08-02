@extends('admin.pages.home')


@section('content')
    <h1 class="title">
        <i class="bi bi-plus-circle-fill"></i> Daftar Sidang
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
    <form action="{{ route('sidang_ta.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_mhs" class="form-label">Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" value="{{ $mahasiswas->nama }}" readonly>
            <input type="hidden" name="id_mhs" id="id_mhs" value="{{ $mahasiswas->id_mhs }}">
        </div>

        <div class="mb-3">
            <label for="id_pengajuan" class="form-label">Judul Tugas Akhir</label>
            <select class="form-select" id="id_pengajuan" name="id_pengajuan" required>
                <option value="">Pilih Judul</option>
                @foreach ($pengajuans as $pengajuan)
                    <option value="{{ $pengajuan->id_tugasakhir }}"
                        {{ old('id_pengajuan') == $pengajuan->id_tugasakhir ? 'selected' : '' }}>
                        {{ $pengajuan->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="full_ta" class="form-label">File Sidang Tugas Akhir</label>
            <input type="file" class="form-control" id="full_ta" name="full_ta" required>
        </div>
        <div class="mb-3">
            <label for="bab_1" class="form-label">Bab 1 TA</label>
            <input type="file" class="form-control" id="bab_1" name="bab_1" required>
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster Sidang Tugas Akhir</label>
            <input type="file" class="form-control" id="poster" name="poster" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sidang_ta.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_mhs').on('change', function() {
                var id_mhs = $(this).val();
                if (id_mhs) {
                    $.ajax({
                        url: '/sidang_ta/get-judul/' + id_mhs,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var pengajuanSelect = $('#id_pengajuan');
                            pengajuanSelect.empty();
                            pengajuanSelect.append('<option value="">Pilih Judul</option>');
                            $.each(response, function(key, pengajuan) {
                                pengajuanSelect.append('<option value="' + pengajuan
                                    .id_tugasakhir + '">' + pengajuan.judul +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    $('#id_pengajuan').empty().append('<option value="">Pilih Judul</option>');
                }
            });
        });
    </script>
@endsection

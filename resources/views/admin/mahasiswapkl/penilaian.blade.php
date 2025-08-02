@extends('admin.pages.home')

@section('title', 'Penilaian PKL')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Penilaian PKL Mahasiswa</h1>
    <form action="{{ route('mahasiswapkl.simpanPenilaian', $mahasiswaPkl->id_mahasiswa_pkl) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Nilai Pembimbing Industri</th>
                                    <td>
                                        <div class="form-group mb-0">
                                            <input type="number"
                                                   class="form-control @error('nilai_pembimbing_industri') is-invalid @enderror"
                                                   name="nilai_pembimbing_industri"
                                                   id="nilai_pembimbing_industri"
                                                   value="{{ old('nilai_pembimbing_industri') }}"
                                                   placeholder="Masukkan nilai (0-100)"
                                                   min="0"
                                                   max="100"
                                                   required>
                                            @error('nilai_pembimbing_industri')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rekomendasi</th>
                                    <td>
                                        <div class="form-group mb-0">
                                            <select class="form-control @error('rekomendasi') is-invalid @enderror"
                                                    name="rekomendasi"
                                                    id="rekomendasi"
                                                    required>
                                                <option value="">Pilih Rekomendasi</option>
                                                <option value="Sangat Direkomendasikan" {{ old('rekomendasi') == 'Sangat Direkomendasikan' ? 'selected' : '' }}>Sangat Direkomendasikan</option>
                                                <option value="Direkomendasikan" {{ old('rekomendasi') == 'Direkomendasikan' ? 'selected' : '' }}>Direkomendasikan</option>
                                                <option value="Cukup Direkomendasikan" {{ old('rekomendasi') == 'Cukup Direkomendasikan' ? 'selected' : '' }}>Cukup Direkomendasikan</option>
                                                <option value="Kurang Direkomendasikan" {{ old('rekomendasi') == 'Kurang Direkomendasikan' ? 'selected' : '' }}>Kurang Direkomendasikan</option>
                                            </select>
                                            @error('rekomendasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Informasi Detail</th>
                                    <td>
                                        <div class="form-group mb-0">
                                            <textarea class="form-control @error('informasi_detail') is-invalid @enderror"
                                                      name="informasi_detail"
                                                      id="informasi_detail"
                                                      rows="4"
                                                      placeholder="Masukkan informasi detail penilaian">{{ old('informasi_detail') }}</textarea>
                                            @error('informasi_detail')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Penilaian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Validasi input nilai hanya angka 0-100
        $('#nilai_pembimbing_industri').on('input', function() {
            let val = $(this).val();
            if (val > 100) $(this).val(100);
            if (val < 0) $(this).val(0);
        });
    });
</script>
@endpush

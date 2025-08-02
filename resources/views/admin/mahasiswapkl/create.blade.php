@extends('admin.pages.home')

@section('title', 'Tambah Data Mahasiswa PKL')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Mahasiswa PKL</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswapkl.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Informasi Utama -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Utama</h6>
                    </div>
                    <div class="mb-3">
                        <label for="id_mahasiswa">Mahasiswa <span class="text-danger">*</span></label>
                        <select class="form-control @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->id_mahasiswa }}" {{ old('id_mahasiswa') == $mhs->id_mahasiswa ? 'selected' : '' }}>
                                    {{ $mhs->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_mahasiswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="id_registrasi_pkl">Tempat PKL <span class="text-danger">*</span></label>
                        <select name="id_registrasi_pkl" id="id_registrasi_pkl" class="form-control @error('id_registrasi_pkl') is-invalid @enderror">
                            <option value="">Pilih Tempat PKL</option>
                            @foreach($registrasi_pkl as $tempatpkl)
                                <option value="{{ $tempatpkl->id_registrasi_pkl }}"
                                    {{ old('id_registrasi_pkl') == $tempatpkl->id_registrasi_pkl ? 'selected' : '' }}>
                                    {{ $tempatpkl->tempatPkl->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_registrasi_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                        <div class="mb-3">
                            <label for="judul">Judul PKL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun_pkl">Tahun PKL</label>
                            <input type="date" class="form-control @error('tahun_pkl') is-invalid @enderror" id="tahun_pkl" name="tahun_pkl" value="{{ old('tahun_pkl') }}">
                            @error('tahun_pkl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_pkl">Pembimbing PKL dari Industri <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pembimbing_pkl') is-invalid @enderror" id="pembimbing_pkl" name="pembimbing_pkl" value="{{ old('pembimbing_pkl') }}" required>
                            @error('pembimbing_pkl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>


                <!-- Dokumen -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Dokumen</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dokument_nilai_industri">Dokumen Nilai Industri</label>
                                <input type="file" class="form-control @error('dokument_nilai_industri') is-invalid @enderror" id="dokument_nilai_industri" name="dokument_nilai_industri" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Format: PDF, DOC, DOCX</small>
                                @error('dokument_nilai_industri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dokument_pkl">Dokumen PKL</label>
                                <input type="file" class="form-control @error('dokument_pkl') is-invalid @enderror" id="dokument_pkl" name="dokument_pkl" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Format: PDF, DOC, DOCX</small>
                                @error('dokument_pkl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dokument_pkl_revisi">Dokumen PKL Revisi</label>
                                <input type="file" class="form-control @error('dokument_pkl_revisi') is-invalid @enderror" id="dokument_pkl_revisi" name="dokument_pkl_revisi" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Format: PDF, DOC, DOCX</small>
                                @error('dokument_pkl_revisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dokument_kuisioner">Dokumen Kuisioner</label>
                                <input type="file" class="form-control @error('dokument_kuisioner') is-invalid @enderror" id="dokument_kuisioner" name="dokument_kuisioner" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Format: PDF, DOC, DOCX</small>
                                @error('dokument_kuisioner')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian PKL -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Penilaian Pembimbing Industri</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">Nilai Pembimbing Industri</th>
                                <td>
                                    <input type="number" class="form-control @error('nilai_pembimbing_industri') is-invalid @enderror" name="nilai_pembimbing_industri" id="nilai_pembimbing_industri" value="{{ old('nilai_pembimbing_industri') }}" placeholder="0-100" min="0" max="100" required>
                                    @error('nilai_pembimbing_industri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Rekomendasi</th>
                                <td>
                                    <select class="form-control @error('rekomendasi') is-invalid @enderror" name="rekomendasi" id="rekomendasi" required>
                                        <option value="">Pilih Rekomendasi</option>
                                        <option value="Sangat Direkomendasikan" {{ old('rekomendasi') == 'Sangat Direkomendasikan' ? 'selected' : '' }}>Sangat Direkomendasikan</option>
                                        <option value="Direkomendasikan" {{ old('rekomendasi') == 'Direkomendasikan' ? 'selected' : '' }}>Direkomendasikan</option>
                                        <option value="Cukup Direkomendasikan" {{ old('rekomendasi') == 'Cukup Direkomendasikan' ? 'selected' : '' }}>Cukup Direkomendasikan</option>
                                        <option value="Kurang Direkomendasikan" {{ old('rekomendasi') == 'Kurang Direkomendasikan' ? 'selected' : '' }}>Kurang Direkomendasikan</option>
                                    </select>
                                    @error('rekomendasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Informasi Detail</th>
                                <td>
                                    <textarea class="form-control @error('informasi_detail') is-invalid @enderror" name="informasi_detail" id="informasi_detail" rows="4">{{ old('informasi_detail') }}</textarea>
                                    @error('informasi_detail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#nilai_pembimbing_industri').on('input', function() {
            let val = $(this).val();
            if (val < 0 || val > 100) {
                alert('Nilai harus berada dalam rentang 0 hingga 100.');
                $(this).val('');
            }
        });
    });
</script>
@endpush

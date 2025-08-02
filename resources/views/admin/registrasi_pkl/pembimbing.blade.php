
@extends('admin.pages.home')

@section('title', 'Tambah Pembimbing PKL')

@section('content')

<style>
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background: linear-gradient(to right, #4e73df, #224abe);
    color: white;
    padding: 1rem;
}

.form-label {
    font-weight: 600;
    color: #4e73df;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 0.35rem;
    padding: 0.75rem;
    border: 1px solid #d1d3e2;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.35rem;
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #224abe;
    border-color: #224abe;
}

.btn-secondary {
    background-color: #858796;
    border-color: #858796;
}

.btn-secondary:hover {
    background-color: #717384;
    border-color: #717384;
}

.invalid-feedback {
    font-size: 0.875rem;
}

.text-danger {
    color: #e74a3b !important;
}

.select2-container--default .select2-selection--single {
    height: calc(1.5em + 1.5rem + 2px);
    padding: 0.75rem;
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
}
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-center h3 mb-0 text-gray-800 ">Tentukan Pembimbing PKL</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('registrasipkl.storepembimbing') }}" method="POST">
                @csrf
                <input type="hidden" name="id_registrasi_pkl" value="{{ $registrasi_pkl->id_registrasi_pkl }}">

                <div class="form-group">
                    <label for="pembimbing_id" class="form-label">Pilih Dosen Pembimbing <span class="text-danger">*</span></label>
                    <select
                        class="form-control @error('pembimbing_id') is-invalid @enderror"
                        id="pembimbing_id"
                        name="pembimbing_id">
                        <option value="" disabled {{ old('pembimbing_id') ? '' : 'selected' }}>Pilih Dosen Pembimbing</option>
                        @foreach ($dosen as $d)
                            <option value="{{ $d->id_dosen }}" {{ old('pembimbing_id') == $d->id_dosen ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pembimbing_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('registrasipkl.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

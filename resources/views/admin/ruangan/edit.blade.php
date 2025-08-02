@extends('admin.pages.home')

@section('title','edit ruangan')

@section('content')
<div class="container">
    <h2>Edit Ruangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">kode Ruangan:</label>
            <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                <option value="">Piih kode Ruangan</option>
                <option value="E-201">E-201</option>
                <option value="E-202">E-202</option>
                <option value="E-203">E-203</option>
                <option value="E-204">E-204</option>
                <option value="E-205">E-205</option>
                <option value="E-206">E-206</option>
                <option value="E-207">E-207</option>
                <option value="E-208">E-208</option>
                <option value="E-209">E-209</option>
                <option value="E-210">E-210</option>
                <option value="E-211">E-211</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nama">Nama Ruangan:</label>
            <select class="form-control" id="nama_ruangan" name="nama_ruangan" required>
                <option value="">Piih Nama ruangan</option>
                <option value="Instalasi">Instalasi</option>
                <option value="multimedia">multimedia</option>
                <option value="pemograman">pemograman</option>

            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="text" name="keterangan" class="form-control" placeholder="keterangan">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection

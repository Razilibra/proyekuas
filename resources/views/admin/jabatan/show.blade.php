@extends('admin.pages.home')

@section('title','Daftar jabatan')
@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Jabatan Details</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $jabatan->id }}</td>
        </tr>
        <tr>
            <th>Jabatan Akademik</th>
            <td>{{ $jabatan->jabatan_akademik }}</td>
        </tr>
    </table>

    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

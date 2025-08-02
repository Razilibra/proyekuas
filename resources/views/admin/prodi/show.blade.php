@extends('admin.pages.home')

@section('title','Daftar Prodi')

@section('content')
<div class="container">
    <h2>Prodi Details</h2>
    <p><strong>Prodi:</strong> {{ $prodi->prodi }}</p>
    <p><strong>Jenjang:</strong> {{ $prodi->jenjang }}</p>
    <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Back to List</a>

</div>
@endsection

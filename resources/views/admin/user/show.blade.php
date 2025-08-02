@extends('admin.pages.home')

@section('title', 'Detail User')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Detail User</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

@extends('admin.pages.home')

@section('title', 'Tambah User')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Tambah User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="level_id">Level:</label>
            <select name="level_id" class="form-control" required>
                <!-- Assuming you have a Level model with id and name fields -->
                @foreach($level as $levels)
                    <option value="{{ $levels->level_id }}">{{ $levels->level }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@extends('admin.pages.home')

@section('title', 'Daftar Users')

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="text-center mb-4">List Data User</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add New User</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>level</th>
                    <th>Username</th>
                    <th width="280px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->level->level ?? '-'  }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id_user) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id_user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

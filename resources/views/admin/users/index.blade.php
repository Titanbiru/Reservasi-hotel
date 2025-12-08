@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Manajemen User</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form class="d-inline" action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                        onsubmit="return confirm('Hapus user ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit User</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password (Kosongkan jika tidak diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="resepsionis" {{ $user->role=='resepsionis'?'selected':'' }}>Resepsionis</option>
                <option value="guest" {{ $user->role=='guest'?'selected':'' }}>Guest</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection

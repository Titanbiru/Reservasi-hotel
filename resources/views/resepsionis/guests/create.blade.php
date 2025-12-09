@extends('layouts.app')

@section('content')
<div class="container mt-3">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3>Tambah Tamu</h3>

    <form action="{{ route('resepsionis.guests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password (default login)</label>
            <input type="password" name="password" class="form-control" minlength="6" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('resepsionis.guests.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

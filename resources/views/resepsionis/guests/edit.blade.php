@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Tamu</h3>

    <form action="{{ route('resepsionis.guests.update',$guest->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $guest->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $guest->email }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('resepsionis.guests.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

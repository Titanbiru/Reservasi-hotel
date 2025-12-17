@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Tambah Kamar</h2>

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tipe Kamar</label>
            <select name="room_type_id" class="form-control">
                @foreach($roomTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nomor Kamar</label>
            <input type="text" name="number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection

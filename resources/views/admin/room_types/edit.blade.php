@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <h1>Edit Room Type</h1>

    <form action="{{ route('admin.room-types.update', $roomType->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Tipe Kamar</label>
            <input type="text" class="form-control" name="name" value="{{ $roomType->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" value="{{ $roomType->description }}"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" name="price" value="{{ $roomType->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" value="{{ $roomType->capacity }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Gambar</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>

@endsection

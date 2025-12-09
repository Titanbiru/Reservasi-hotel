@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Edit Fasilitas</h2>

    <form action="{{ route('admin.facilities.update',$facility->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Fasilitas</label>
            <input type="text" name="name" value="{{ $facility->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $facility->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jenis Fasilitas</label>
            <select name="type" class="form-control">
                <option value="hotel" {{ $facility->type == 'hotel' ? 'selected' : '' }}>Fasilitas Hotel</option>
                <option value="room" {{ $facility->type == 'room' ? 'selected' : '' }}>Fasilitas Kamar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Baru (opsional)</label>
            <input type="file" name="image" class="form-control">
            @if($facility->image)
                <img src="{{ asset('storage/'.$facility->image) }}" width="90" class="mt-2">
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection

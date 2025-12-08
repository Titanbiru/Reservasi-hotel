@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Fasilitas</h2>

    <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Fasilitas</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection

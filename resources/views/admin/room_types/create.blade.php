@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tambah Tipe Kamar</h1>

    <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="capacity" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">Kembali</a>
        
    </form>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <h2>Tambah Banner</h2>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul (Opsional)</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Subjudul (Opsional)</label>
            <textarea name="subtitle" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Banner</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <button class="btn btn-success">
            Simpan Banner
        </button>

        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            Batal
        </a>

    </form>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Banner</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
        Tambah Banner
    </a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        Kembali
    </a>


    <table class="table table-bordered align-middle mt-3">
        <thead>
            <tr>
                <th width="120">Gambar</th>
                <th>Judul</th>
                <th>Subjudul</th>
                <th>Status</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($banners as $banner)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$banner->image) }}" class="img-fluid rounded" style="max-height:70px">
                    </td>
                    <td>{{ $banner->title ?? '-' }}</td>
                    <td>{{ $banner->subtitle ?? '-' }}</td>
                    <td>
                        @if($banner->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>

                    <td class="d-flex gap-1">

                        <form action="{{ route('admin.banners.toggle',$banner->id) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm 
                                {{ $banner->is_active ? 'btn-warning' : 'btn-success' }}">
                                {{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.banners.destroy',$banner->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus banner ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada banner
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

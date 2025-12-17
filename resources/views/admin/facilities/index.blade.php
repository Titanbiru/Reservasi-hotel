@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Fasilitas</h2>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">Tambah Fasilitas</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>

        @forelse($facilities as $f)
            <tr>
                <td class="fw-semibold">{{ $f->name }}</td>

                <td>
                    <span class="badge {{ $f->type === 'hotel' ? 'bg-info' : 'bg-warning' }}">
                        {{ ucfirst($f->type) }}
                    </span>
                </td>

                <td>{{ Str::limit($f->description, 60) }}</td>

                <td>
                    <img 
                        src="{{ $f->image ? asset('storage/'.$f->image) : asset('images/no-image.png') }}"
                        width="70"
                        class="rounded border"
                    >
                </td>

                <td>
                    <a href="{{ route('admin.facilities.edit',$f->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.facilities.destroy',$f->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus fasilitas ini?')" class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada fasilitas
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

    {{ $facilities->links() }}

</div>
@endsection

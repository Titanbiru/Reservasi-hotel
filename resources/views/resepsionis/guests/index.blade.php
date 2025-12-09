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

    <h2 class="mb-4">Daftar Tamu (Guest)</h2>

    <div class="">
        <a href="{{ route('resepsionis.guests.create') }}" class="btn btn-primary mb-3">+ Tambah Tamu</a>
        <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>No HP</th>
                <th width="180px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guests as $guest)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->email }}</td>
                <td>{{ $guest->phone ?? '-' }}</td>

                <td>
                    <a href="{{ route('resepsionis.guests.edit', $guest->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('resepsionis.guests.destroy',$guest->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin hapus tamu?')" class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada tamu terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>


    <div class="mt-3">
        {{ $guests->links() }}
    </div>

</div>
@endsection

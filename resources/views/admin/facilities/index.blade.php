@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Data Fasilitas Hotel</h2>
    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary mb-3">Tambah Fasilitas</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilities as $f)
            <tr>
                <td>{{ $f->name }}</td>
                <td>{{ $f->description }}</td>
                <td>
                    @if($f->image)
                        <img src="{{ asset('storage/'.$f->image)}}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.facilities.edit',$f->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.facilities.destroy',$f->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus fasilitas?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

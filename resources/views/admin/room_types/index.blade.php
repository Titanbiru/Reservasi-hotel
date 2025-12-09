@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <h2 class="mb-3">Manajemen Tipe Kamar</h2>

    <a href="{{ route('admin.room-types.create') }}" class="btn btn-success mb-3">
        Tambah Tipe Kamar
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roomTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>Rp {{ number_format($type->price,0,',','.') }}</td>
                    <td>
                        <a href="{{ route('admin.room-types.edit',$type->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('admin.room-types.destroy',$type->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ">Kembali</a>

</div>
@endsection

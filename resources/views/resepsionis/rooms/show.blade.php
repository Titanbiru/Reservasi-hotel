@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Detail Kamar Nomor {{ $room->number }}</h3>

    <div class="card p-4">

        <p><strong>Tipe Kamar:</strong> {{ $room->roomType->name }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($room->roomType->price,0,',','.') }}</p>
        <p><strong>Status:</strong> {{ $room->status }}</p>
        <p><strong>Deskripsi:</strong><br>{{ $room->roomType->description }}</p>

        <a href="{{ route('resepsionis.rooms.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>

</div>
@endsection

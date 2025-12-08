@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">Reservasi: {{ $room_type->name }}</h1>

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <input type="hidden" name="room_type_id" value="{{ $room_type->id }}">

        <div class="mb-3">
            <label>Nama Tamu</label>
            <input type="text" name="guest_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="guest_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="guest_phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Check-in</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Check-out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Kamar</label>
            <input type="number" name="room_count" class="form-control" required min="1" value="1">
        </div>
        
        <div class="mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">← Kembali</a>
            <button class="btn btn-primary">Konfirmasi Pesanan</button>
        </div>

    </form>

</div>
@endsection

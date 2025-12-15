@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1>Detail Reservasi</h1>
.
    <div class="button d-flex gap-2 mb-3">
        <a href="{{ route('resepsionis.reservations.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        @if($reservation->status === 'pending')
            <form action="{{ route('resepsionis.reservations.confirm', $reservation->id) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-warning">Konfirmasi Booking</button>
            </form>
        
        @elseif($reservation->status === 'confirmed')
            <form action="{{ route('resepsionis.reservations.checkin', $reservation->id) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-success">Check In</button>
            </form>
        
        @elseif($reservation->status === 'checked_in')
            <form action="{{ route('resepsionis.reservations.checkout', $reservation->id) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-primary">Check Out</button>
            </form>
        
        @elseif($reservation->status === 'check_out')
            <span class="badge bg-secondary">Selesai</span>
        @endif
    </div>

    <p><strong>Kode:</strong> {{ $reservation->reservation_code }}</p>
    <p><strong>Nama Tamu:</strong> {{ $reservation->guest_name }}</p>
    <p><strong>Email:</strong> {{ $reservation->guest_email }}</p>
    <p><strong>No HP:</strong> {{ $reservation->guest_phone }}</p>

    <p><strong>Tipe Kamar:</strong> {{ $reservation->roomType->name }}</p>
    <p><strong>Jumlah Kamar:</strong> {{ $reservation->room_count }}</p>

    <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
    <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>

    <p><strong>Total Harga:</strong> Rp {{ number_format($reservation->total_price,0,',','.') }}</p>

</div>
@endsection
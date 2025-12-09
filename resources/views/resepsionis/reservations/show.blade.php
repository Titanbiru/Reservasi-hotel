@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <h1>Detail Reservasi</h1>

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
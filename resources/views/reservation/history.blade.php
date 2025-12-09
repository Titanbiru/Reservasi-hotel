@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <h2 class="fw-bold mb-4">Riwayat Reservasi Anda</h2>

    <div class="card-body p-2 shadow-sm">

        @forelse ($reservations as $r)
            <div class="card mb-3 p-3 shadow-sm">
                <h5 class="fw-bold">Kode Reservasi: {{ $r->booking_code }}</h5>
                <p class="mb-1">Check-in: {{ $r->check_in }}</p>
                <p class="mb-1">Check-out: {{ $r->check_out }}</p>
                <p class="mb-1">Jumlah Kamar: {{ $r->room_count }}</p>
    
                <a href="{{ route('reservation.print', $r->reservation_code) }}" class="btn btn-primary mt-2">
                    Lihat Bukti Reservasi
                </a>
            </div>
        @empty
            <p class="text-muted">Anda belum memiliki reservasi.</p>
        @endforelse
    </div>
    
    <a href="{{ route('home') }}" class="btn btn-secondary m-3">← Kembali</a>

</div>
@endsection

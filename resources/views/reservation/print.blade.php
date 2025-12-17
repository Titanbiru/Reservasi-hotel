@extends('layouts.app')

@section('content')

<style>
    .print-container {
        max-width: 600px;
        margin: auto;
        border: 2px solid #000;
        padding: 20px;
        background: white;
    }

    .label {
        font-weight: bold;
        width: 180px;
        display: inline-block;
    }

    @media print {
        nav, .navbar, .btn, .print-btn, .back-btn {
            display: none !important;
        }
        body {
            padding: 0;
            margin: 0;
        }
    }
</style>

<div class="print-container mt-3">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <h2 class="text-center mb-4">Bukti Reservasi Hotel</h2>

    <div class="mb-2"><span class="label">Kode Reservasi:</span> {{ $reservation->reservation_code }}</div>
    <div class="mb-2"><span class="label">Nama Tamu:</span> {{ $reservation->guest_name }}</div>
    <div class="mb-2"><span class="label">Email:</span> {{ $reservation->guest_email }}</div>
    <div class="mb-2"><span class="label">No. Telepon:</span> {{ $reservation->guest_phone }}</div>
    <div class="mb-2"><span class="label">Tipe Kamar:</span> {{ $reservation->roomType->name }}</span></div>
    <div class="mb-2"><span class="label">Check-in:</span> {{ $reservation->check_in }}</div>
    <div class="mb-2"><span class="label">Check-out:</span> {{ $reservation->check_out }}</div>
    <div class="mb-2"><span class="label">Jumlah Kamar:</span> {{ $reservation->room_count }}</div>
    <div class="mb-2"><span class="label">Total Harga:</span>
        Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
    </div>
    <div class="mb-2"><span class="label">Status Reservasi:</span> {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}</div>    
</div>
<div class="text-center">
    <div class=" print-btn mt-4 d-flex justify-content-center gap-2 mb-3">    
        <a href="{{ route('reservation.pdf', $reservation->reservation_code) }}" 
            class="btn btn-success">
            Download PDF
        </a>
        <a href="{{ route('reservation.history') }}" class="btn btn-primary">History Reservasi</a>
        @if(in_array($reservation->status, ['pending','confirmed']))
        <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
            @csrf
            @method('PATCH')
            <button class="btn btn-danger">
                Cancel Reservasi
            </button>
        </form>
        @endif
    </div>
    <div class="print-btn">
        <a href="{{ route('reservation.create',$reservation->room_type_id) }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
</div>



@endsection

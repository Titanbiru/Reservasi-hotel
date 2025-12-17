@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1>Detail Reservasi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
.
    <div class="button d-flex gap-2 mb-3">
        @if($reservation->status === 'pending')
            <form action="{{ route('resepsionis.reservations.confirm', $reservation->id) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-warning">Konfirmasi Booking</button>
            </form>
        
        
        @elseif($reservation->status === 'checked_in')
            <form action="{{ route('resepsionis.reservations.checkout', $reservation->id) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-primary">Check Out</button>
            </form>
        
        @elseif($reservation->status === 'check_out')
            <span class="badge bg-success">Selesai</span>
        @endif
    </div>
    <a href="{{ route('resepsionis.reservations.index') }}" class="btn btn-secondary mb-3">
        Kembali ke Daftar Reservasi
    </a>

    @if($reservation->status === 'confirmed')
    <form action="{{ route('resepsionis.reservations.checkin', $reservation->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH')

        <div class="mb-2">
            <label class="form-label">Pilih Kamar</label>
            <select name="room_id" class="form-select" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach($availableRooms as $room)
                    <option value="{{ $room->id }}">
                        Kamar {{ $room->number }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Check In</button>
    </form>
    @endif


    <table class="table table-bordered mb-4">
        <tr>
            <th>Kode Reservasi</th>
            <td>{{ $reservation->reservation_code }}</td>
        </tr>
        <tr>
            <th>Nama Tamu</th>
            <td>{{ $reservation->guest_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $reservation->guest_email }}</td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>{{ $reservation->guest_phone }}</td>
        </tr>
        <tr>
            <th>Tipe Kamar</th>
            <td>{{ $reservation->roomType->name }}</td>
        </tr>
        <tr>
            <th>Jumlah Kamar</th>
            <td>{{ $reservation->room_count }}</td>
        </tr>
        <tr>
            <th>Check-in</th>
            <td>{{ $reservation->check_in }}</td>
        </tr>
        <tr>
            <th>Check-out</th>
            <td>{{ $reservation->check_out }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($reservation->total_price,0,',','.') }}</td>
        </tr>
    </table>

</div>
@endsection
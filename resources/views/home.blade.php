@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Hero Banner -->
    <div class="p-5 mb-5 rounded shadow-sm hero-section"
        style="background: url('{{ asset('images/hotel-banner.jpg') }}') center/cover no-repeat;">
        <h1 class="fw-bold display-5">Selamat Datang di Hotel Hebat</h1>
        <p class="lead">Pengalaman menginap nyaman, fasilitas lengkap, dan pelayanan terbaik</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-light fw-bold px-4 mt-3">Login untuk Reservasi</a>
        @else
            <a href="{{ route('reservation.create', $roomTypes->first()->id ?? 1) }}" class="btn btn-warning fw-bold px-4 mt-3">
                Pesan Sekarang
            </a>
        @endguest
    </div>


    <!-- Tipe Kamar -->
    <h2 class="mb-4 fw-bold">Tipe Kamar Tersedia</h2>
    <div class="row">
        @forelse ($roomTypes as $room)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 room-card">

                    <img src="{{ $room->image 
                        ? asset('storage/'.$room->image)
                        : asset('images/default-room.jpg') }}"
                        class="card-img-top room-image" alt="Room Image">

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $room->name }}</h5>
                        <p class="text-muted">{{ Str::limit($room->description, 80) }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">Rp {{ number_format($room->price,0,',','.') }}/malam</span>
                            <a href="{{ route('room-type.detail', $room->id) }}" 
                                class="btn btn-outline-primary btn-sm">Detail</a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada tipe kamar terdaftar.</p>
        @endforelse
    </div>


    <!-- Fasilitas -->
    <h2 class="mt-5 fw-bold">Fasilitas Hotel</h2>
    <div class="row mt-3">
        @forelse ($hotelFacilities as $f)
            <div class="col-md-3 col-6 mb-3">
                <div class="p-3 text-center rounded shadow-sm border facility-box">
                    <span class="fw-semibold">{{ $f->name }}</span>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada fasilitas hotel terdaftar.</p>
        @endforelse
    </div>

</div>

<style>
    .hero-section { 
        min-height: 280px; 
        display:flex; 
        flex-direction:column; 
        align-items:center; 
        justify-content:center;
        color: black;
        text-shadow: 0 1px 4px rgba(0,0,0,0.7);
    }

    .room-card { transition: .25s; border-radius: 10px; overflow:hidden; }
    .room-card:hover { transform: scale(1.02); box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
    .room-image { height: 200px; object-fit: cover; }

    .facility-box { background:#f8f9fa; transition:.25s; }
    .facility-box:hover { background:#e9ecef; transform:scale(1.05); }
</style>
@endsection

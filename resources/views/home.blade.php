@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Hero Banner -->
    @if($banners->count())
    <div id="hotelCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="hero-section"
                    style="background: url('{{ asset('storage/'.$banner->image) }}') center/cover no-repeat;">
                </div>
            </div>
            @endforeach
        </div>
        <div class="carousel-caption d-none d-md-block">
            @if($banner->title || $banner->subtitle)
                @if($banner->title)
                    <h2>{{ $banner->title }}</h2>
                @endif

                @if($banner->subtitle)
                    <p>{{ $banner->subtitle }}</p>
                @endif
            @endif
            @guest
                <a href="{{ route('login') }}" class="btn btn-light fw-bold px-4 mt-3">Login untuk Reservasi</a>
            @else
                <a href="{{ route('reservation.create', $roomTypes->first()->id ?? 1) }}" class="btn btn-warning fw-bold px-4 mt-3">
                    Pesan Sekarang
                </a>
                <a href="{{ route('reservation.history') }}" class="btn btn-outline-info fw-bold px-4 mt-3">
                    Lihat Reservasi Saya
                </a>
            @endguest
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    @endif



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
            <div class="col-md-3 col-6 mb-4">
                <div class="card h-100 shadow-sm border-0 facility-card">

                    <img
                        src="{{ $f->image
                            ? asset('storage/'.$f->image)
                            : asset('images/default-facility.jpg') }}"
                        class="card-img-top facility-image"
                        alt="{{ $f->name }}">

                    <div class="card-body text-center">
                        <h6 class="fw-bold mb-1">{{ $f->name }}</h6>
                        <p class="text-muted small">
                            {{ Str::limit($f->description, 60) }}
                        </p>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada fasilitas hotel.</p>
        @endforelse
    </div>


</div>

<style>
    .hero-section { 
        min-height: 280px; 
        display:flex; 
        flex-direction:column; 
    }
    
    .carousel-caption {
        bottom: 20%;
        align-items:center; 
        justify-content:center;
        color: white;
        font-weight: bold;
        text-shadow: 2px 4px 4px rgba(0,0,0,0.7);
    }
    
    .carousel-caption h2 {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 4px 4px rgba(0,0,0,0.7);
    }

    .room-card { transition: .25s; border-radius: 10px; overflow:hidden; }
    .room-card:hover { transform: scale(1.02); box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
    .room-image { height: 200px; object-fit: cover; }

    .facility-box { background:#f8f9fa; transition:.25s; }
    .facility-box:hover { background:#e9ecef; transform:scale(1.05); }
    .facility-card {
        transition: .25s;
        border-radius: 10px;
        overflow: hidden;
    }

    .facility-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,.12);
    }

    .facility-image {
        height: 140px;
        object-fit: cover;
    }

</style>
@endsection

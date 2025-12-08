@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $roomType->name }}</h1>

    @if($roomType->image)
        <img src="{{ asset('storage/' . $roomType->image) }}" class="img-fluid mb-3" width="400">
    @endif

    <p>{{ $roomType->description }}</p>
    <p>Kapasitas: <strong>{{ $roomType->capacity }}</strong></p>
    <p>Harga: <strong>Rp {{ number_format($roomType->price,0,',','.') }}</strong></p>

    <h3>Fasilitas Kamar:</h3>
    <ul>
        @foreach ($roomType->facilities as $facility)
            <li>{{ $facility->name }}</li>
        @endforeach
    </ul>

    @guest
        <a href="{{ route('login') }}" class="btn btn-warning mt-3"
            onclick="return confirm('Anda harus login untuk melakukan reservasi. Lanjut ke halaman login?')">
            Login untuk Memesan
        </a>
    @endguest

    @auth
        <a href="{{ route('reservation.create', $roomType->id) }}" class="btn btn-success mt-3">
            Pesan Kamar Ini
        </a>
    @endauth

    <a href="{{route('home')}}" class="btn btn-secondary mt-3">Kembali</a>


</div>
@endsection

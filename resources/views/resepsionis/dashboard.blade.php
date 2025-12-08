@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white min-vh-100 py-4">
            <h4 class="text-center">Resepsionis</h4>
            <hr class="border-light">

            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('resepsionis.dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('resepsionis.reservations.index') }}" class="nav-link text-white">Data Reservasi</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('resepsionis.rooms.index') }}" class="nav-link text-white">Daftar Kamar</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('resepsionis.guests.index') }}" class="nav-link text-white">Data Tamu</a>
                </li>
            </ul>

            <hr>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">

            <h2>Dashboard Resepsionis</h2>
            <p>Selamat datang, {{ auth()->user()->name }}.</p>

            <div class="row mt-4">

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Total Reservasi Hari Ini</h5>
                            <h2 class="text-primary">{{$totalReservasiToday}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Kamar Tersedia</h5>
                            <h2 class="text-success">{{$kamarTersedia}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Kamar Terisi</h5>
                            <h2 class="text-danger">{{$kamarTerisi}}</h2>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <h4>Aktivitas Terbaru</h4>
            <p>Belum ada aktivitas terbaru.</p>

        </div>
    </div>
</div>
@endsection

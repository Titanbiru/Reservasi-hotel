@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white min-vh-100 py-4">
            <h4 class="text-center">Administrator</h4>
            <hr class="border-light">

            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.room-types.index') }}" class="nav-link text-white">Tipe Kamar</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.facilities.index') }}" class="nav-link text-white">Fasilitas</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.rooms.index') }}" class="nav-link text-white">Daftar Kamar</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-white">Kelola Pengguna</a>
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

            <h2>Dashboard Admin</h2>
            <p>Selamat datang, {{ auth()->user()->name }}.</p>

            <div class="row mt-4">

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Total Kamar</h5>
                            <h2 class="text-primary">{{$totalRooms}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Jenis Tipe Kamar</h5>
                            <h2 class="text-success">{{$totalRoomTypes}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Jumlah User</h5>
                            <h2 class="text-warning">{{$totalUsers}}</h2>
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

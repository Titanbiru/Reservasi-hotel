@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Data Reservasi</h1>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Cari nama tamu">
            </div>
            <div class="col-md-4">
                <input type="date" name="check_in" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <th>Nama Tamu</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Tipe</th>
        </tr>

        @foreach ($reservations as $r)
        <tr>
            <td>{{ $r->reservation_code }}</td>
            <td>{{ $r->guest_name }}</td>
            <td>{{ $r->check_in }}</td>
            <td>{{ $r->check_out }}</td>
            <td>{{ $r->roomType->name }}</td>
        </tr>
        @endforeach
    </table>

    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Kembali</a>

</div>
@endsection

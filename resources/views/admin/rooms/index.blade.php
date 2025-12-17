@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2 class="mb-3">Data Kamar Hotel</h2>
    
    <form method="GET" action="{{ route('admin.rooms.index') }}" class="mb-3 d-flex align-items-center">
        <label class="me-2">Show</label>
        <select name="show" onchange="this.form.submit()" class="form-select w-auto me-2">
            <option value="50" {{ $show == 50 ? 'selected' : '' }}>50</option>
            <option value="all" {{ $show == 'all' ? 'selected' : '' }}>Show All</option>
        </select>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mb-3">Tambah Kamar</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kamar</th>
                <th>Tipe Kamar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->number }}</td>
                <td>{{ $r->roomType->name }}</td>
                <td>
                    @php
                        $badgeClass = match ($r->status) {
                            'occupied'    => 'bg-danger',
                            'maintenance' => 'bg-warning',
                            'available'   => 'bg-success',
                            default       => 'bg-secondary',
                        };
                    @endphp

                    <span class="badge {{ $badgeClass }}">
                        @if($r->status === 'occupied' && $r->reservation)
                            Occupied by {{ $r->reservation->guest_name }}
                        @else
                            {{ ucfirst($r->status) }}
                        @endif
                    </span>
                </td>


                <td>
                    <a href="{{ route('admin.rooms.edit',$r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.rooms.destroy',$r->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin hapus kamar?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        @if($show !== 'all')
            {{ $rooms->links() }}
        @endif
    </div>


</div>
@endsection

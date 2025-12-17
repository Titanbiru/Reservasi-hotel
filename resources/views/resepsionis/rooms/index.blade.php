@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h3>List Kamar Hotel</h3>

    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No Kamar</th>
                <th>Tipe</th>
                <th>Status</th>
                <th width="120">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
            <tr>
                <td>{{ $room->number }}</td>
                <td>{{ $room->roomType->name ?? '-' }}</td>
                <td>
                @php
                    $badgeClass = match ($room->status) {
                        'occupied'    => 'bg-danger',
                        'maintenance' => 'bg-warning',
                        'available'   => 'bg-success',
                        default       => 'bg-secondary',
                    };
                @endphp

                <span class="badge {{ $badgeClass }}">
                    @if($room->status === 'occupied' && $room->reservation)
                        Occupied by {{ $room->reservation->guest_name }}
                    @else
                        {{ ucfirst($room->status) }}
                    @endif
                </span>
            </td>

                <td>
                    <a href="{{ route('resepsionis.rooms.show',$room->id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Belum ada data kamar</td></tr>
            @endforelse
        </tbody>
    </table>
    

    {{ $rooms->links() }}
</div>
@endsection

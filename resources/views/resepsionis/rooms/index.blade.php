@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h3>List Kamar Hotel</h3>

    <table class="table table-bordered table-striped mt-3">
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
                <td>{{ $room->status }}</td>
                <td>
                    <a href="{{ route('resepsionis.rooms.show',$room->id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Belum ada data kamar</td></tr>
            @endforelse
        </tbody>
    </table>
    
        <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Kembali</a>

    {{ $rooms->links() }}
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Edit Kamar</h2>

    <form action="{{ route('admin.rooms.update',$room->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Tipe Kamar</label>
            <select name="room_type_id" class="form-control">
                @foreach($roomTypes as $type)
                <option value="{{ $type->id }}" {{ $room->room_type_id==$type->id?'selected':'' }}>
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nomor Kamar</label>
            <input type="text" name="number" value="{{ $room->number }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="available" {{ $room->status=='available'?'selected':'' }}>Available</option>
                <option value="occupied" {{ $room->status=='occupied'?'selected':'' }}>Occupied</option>
                <option value="maintenance" {{ $room->status=='maintenance'?'selected':'' }}>Maintenance</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection

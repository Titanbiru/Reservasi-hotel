@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-3">Manajemen Reservasi</h2>

    {{-- Filter --}}
    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-2">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Nama Tamu</label>
                <input type="text" name="q" class="form-control"
                    placeholder="Cari nama tamu"
                    value="{{ request('q') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Tanggal Check-in</label>
                <input type="date" name="check_in" class="form-control"
                    value="{{ request('check_in') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>Pending</option>
                    <option value="confirmed" {{ request('status')=='confirmed' ? 'selected':'' }}>Confirmed</option>
                    <option value="checked_in" {{ request('status')=='checked_in' ? 'selected':'' }}>Checked In</option>
                    <option value="check_out" {{ request('status')=='check_out' ? 'selected':'' }}>Check Out</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected':'' }}>Cancelled</option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filter</button>
            </div>

        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama Tamu</th>
                    <th>Tipe Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($reservations as $r)
                <tr>
                    <td class="fw-bold">{{ $r->reservation_code }}</td>
                    <td>{{ $r->guest_name }}</td>
                    <td>{{ $r->roomType->name }}</td>

                    <td>{{ \Carbon\Carbon::parse($r->check_in)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->check_out)->format('d M Y') }}</td>

                    <td>
                        @php
                            $colors = [
                                'pending' => 'warning',
                                'confirmed' => 'primary',
                                'checked_in' => 'success',
                                'check_out' => 'secondary',
                                'cancelled' => 'danger',
                            ];
                        @endphp

                        <span class="badge bg-{{ $colors[$r->status] ?? 'dark' }}">
                            {{ ucfirst(str_replace('_',' ', $r->status)) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('resepsionis.reservations.show', $r->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            Detail
                        </a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination (opsional) --}}
    <div>
        {{ $reservations->links() }}
    </div>

    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>

</div>
@endsection

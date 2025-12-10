<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Reservasi</title>

    <style>
        body {
            font-family: sans-serif;
            background: white;
            font-size: 14px;
        }

        .container {
            padding: 20px;
            border: 2px solid #000;
        }

        .main-content {
            display: flex;
            justify-content: center;
        }

        .wrapped {
            margin-top: 20px;
            line-height: 1.6;
            width: 768px;
        }

        .label {
            font-weight: bold;
            width: 180px;
            display: inline-block;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .item {
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

    <div class="container">

        <h2>Bukti Reservasi Hotel</h2>
        <div class="main-content">
            <div class="wrapped">
                <div class="item"><span class="label">Kode Reservasi:</span> {{ $reservation->reservation_code }}</div>
                <div class="item"><span class="label">Nama Tamu:</span> {{ $reservation->guest_name }}</div>
                <div class="item"><span class="label">Email:</span> {{ $reservation->guest_email }}</div>
                <div class="item"><span class="label">No. Telepon:</span> {{ $reservation->guest_phone }}</div>
                <div class="item"><span class="label">Tipe Kamar:</span> {{ $reservation->roomType->name }}</div>
                <div class="item"><span class="label">Check-in:</span> {{ $reservation->check_in }}</div>
                <div class="item"><span class="label">Check-out:</span> {{ $reservation->check_out }}</div>
                <div class="item"><span class="label">Jumlah Kamar:</span> {{ $reservation->room_count }}</div>
                <div class="item"><span class="label">Total Harga:</span> Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</div>
            </div>
        </div>

    </div>

</body>
</html>

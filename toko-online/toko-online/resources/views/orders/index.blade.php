<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <a href="{{ route('products.index') }}">&laquo; Kembali ke Katalog</a>

    <h2>Riwayat Pesanan Saya</h2>

    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif

    @if($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Alamat Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><strong>{{ $order->id_order }}</strong></td>
                        <td>{{ $order->tanggal_order }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->alamat_pengiriman }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id_order) }}">[ Lihat Detail ]</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada riwayat pesanan.</p>
    @endif

</body>
</html>
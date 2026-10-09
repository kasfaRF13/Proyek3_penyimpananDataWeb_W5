<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan - {{ $order->id_order }}</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .box { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body>

    <a href="{{ route('orders.index') }}">&laquo; Kembali ke Riwayat Pesanan</a>

    <h2>Detail Pesanan #{{ $order->id_order }}</h2>

    <div class="box">
        <p><strong>Tanggal Order:</strong> {{ $order->tanggal_order }}</p>
        <p><strong>Pembeli:</strong> {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->email }})</p>
        <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>
    </div>

    <h3>Barang yang Dibeli:</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah Beli</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $item)
                <tr>
                    <td>{{ $item->nama_barang }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah_beli }}</td>
                    <td>Rp {{ number_format($item->harga_satuan * $item->jumlah_beli, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 20px;">Total Pembayaran: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h3>

</body>
</html>
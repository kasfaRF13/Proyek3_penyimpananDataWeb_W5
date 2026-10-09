<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .cart-item { border-bottom: 1px solid #ddd; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; width: 500px; }
        .qty-btn { background: #eee; border: 1px solid #ccc; padding: 2px 6px; cursor: pointer; }
        .btn-checkout { background: #2196F3; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; border-radius: 4px; margin-top: 15px; }
    </style>
</head>
<body>

    <a href="{{ route('products.index') }}">&laquo; Kembali ke Katalog</a>

    <h2>Keranjang Belanja Kamu</h2>

    @if(session('error')) <p style="color: red;">{{ session('error') }}</p> @endif

    @if(count($cartItems) > 0)
        @foreach($cartItems as $item)
            <div class="cart-item">
                <div>
                    <strong>{{ $item['nama'] }}</strong><br>
                    <small>Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</small><br>
                    <small style="color: #666;">(Stok max: {{ $item['stok'] }})</small>
                </div>

                <div style="display: flex; align-items: center; gap: 5px;">
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="submit" class="qty-btn">-</button>
                    </form>

                    <span>{{ $item['jumlah'] }}</span>

                    <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="submit" class="qty-btn">+</button>
                    </form>

                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="margin-left: 10px;">
                        @csrf
                        <button type="submit" style="color: red;">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

        <h3>Total Bayar: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>

        <!-- Form Checkout -->
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <h4>Alamat Pengiriman:</h4>
            <textarea name="alamat_pengiriman" rows="3" cols="50" required>{{ Auth::user()->alamat }}</textarea><br>
            <button type="submit" class="btn-checkout">Checkout Sekarang</button>
        </form>
    @else
        <p>Keranjang kamu masih kosong.</p>
    @endif

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        .cart-item { border-bottom: 1px solid #eee; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; width: 450px; }
        .qty-btn { background: #eee; border: 1px solid #ccc; padding: 2px 6px; cursor: pointer; text-decoration: none; color: #000; font-weight: bold; }
        .btn-delete { background: #ffd2d2; border: 1px solid #ff8888; padding: 2px 6px; cursor: pointer; margin-left: 5px; }
        .total-box { margin-top: 15px; font-weight: bold; font-size: 1.1em; }
        .btn-clear { background: #f2f2f2; border: 1px solid #888; padding: 6px 12px; margin-top: 10px; cursor: pointer; }
        .back-link { display: inline-block; margin-bottom: 15px; text-decoration: none; color: blue; }
    </style>
</head>
<body>

    <a href="{{ route('barang.index') }}" class="back-link">&laquo; Kembali ke Toko</a>

    <div class="header">
        <h2>Keranjang belanja</h2>
        <span style="color: #666;">Tanpa login</span>
    </div>

    @if(count($cartItems) > 0)
        @foreach($cartItems as $item)
            <div class="cart-item">
                <div>
                    <strong>{{ $item['nama'] }}</strong><br>
                    <small>Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</small>
                </div>

                <div style="display: flex; align-items: center; gap: 5px;">
                    <!-- Tombol Minus (-) -->
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="submit" class="qty-btn">[-]</button>
                    </form>

                    <span>{{ $item['jumlah'] }}</span>

                    <!-- Tombol Plus (+) -->
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="submit" class="qty-btn">[+]</button>
                    </form>

                    <!-- Tombol Hapus (hps) -->
                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-delete">[hps]</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="total-box">
            Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}
        </div>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn-clear">[ Kosongkan keranjang ]</button>
        </form>
    @else
        <p>Keranjang belanja kamu masih kosong.</p>
    @endif

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        .cart-btn { background-color: #f0f0f0; border: 1px solid #aaa; padding: 6px 12px; text-decoration: none; color: #000; border-radius: 4px; }
        .product-list { margin-top: 20px; display: flex; flex-direction: column; gap: 15px; }
        .product-card { border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 6px; }
        .btn-add { background-color: #e0e0e0; border: 1px solid #888; padding: 5px 10px; cursor: pointer; border-radius: 3px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Toko Alat Tulis</h2>
        <a href="{{ route('cart.show') }}" class="cart-btn">[ Keranjang ({{ $totalItems }}) ]</a>
    </div>

    <h3>Daftar barang</h3>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="product-list">
        @foreach($barangs as $barang)
            <div class="product-card">
                <strong>[img] {{ $barang->nama }}</strong><br>
                Rp {{ number_format($barang->harga, 0, ',', '.') }}<br><br>
                
                <form action="{{ route('cart.add', $barang->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add">[Masukkan ke krj]</button>
                </form>
            </div>
        @endforeach
    </div>

</body>
</html>
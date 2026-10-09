<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Produk - Toko Online</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        .grid { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
        .card { border: 1px solid #ccc; padding: 15px; width: 220px; border-radius: 6px; }
        .btn-add { background: #4CAF50; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .btn-disabled { background: #ccc; color: #666; border: none; padding: 6px 12px; cursor: not-allowed; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Toko Online</h2>
        <div>
            @auth
                <span>Halo, <strong>{{ Auth::user()->nama_lengkap }}</strong></span> | 
                <a href="{{ route('cart.show') }}">[ Keranjang ({{ $totalItems }}) ]</a> |
                <a href="{{ route('orders.index') }}">[ Riwayat Pesanan ]</a> |
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">[ Logout ]</button>
                </form>
            @else
                <a href="{{ route('login') }}">[ Login ]</a> | 
                <a href="{{ route('register') }}">[ Register ]</a>
            @endauth
        </div>
    </div>

    <h3>Daftar Produk</h3>

    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif
    @if(session('error')) <p style="color: red;">{{ session('error') }}</p> @endif

    <div class="grid">
        @foreach($products as $product)
            <div class="card">
                <strong>[ {{ $product->nama_barang }} ]</strong><br>
                <small>{{ $product->deskripsi }}</small><br><br>
                <strong>Rp {{ number_format($product->harga, 0, ',', '.') }}</strong><br>
                <small>Stok: {{ $product->stok }}</small><br><br>

                @if($product->stok > 0)
                    @auth
                        <form action="{{ route('cart.add', $product->id_barang) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add">+ Keranjang</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" style="font-size: 0.9em; color: blue;">Login untuk membeli</a>
                    @endauth
                @else
                    <button class="btn-disabled" disabled>Stok Habis</button>
                @endif
            </div>
        @endforeach
    </div>

</body>
</html>
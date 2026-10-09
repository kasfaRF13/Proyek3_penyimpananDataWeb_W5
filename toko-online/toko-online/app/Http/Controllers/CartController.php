<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tambah Produk ke Keranjang
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stok <= 0) {
            return redirect()->back()->with('error', 'Stok barang habis!');
        }

        $cart = session()->get('cart', []);
        $currentQty = isset($cart[$id]) ? $cart[$id] : 0;

        // Validasi tidak boleh melebihi stok
        if ($currentQty + 1 > $product->stok) {
            return redirect()->back()->with('error', 'Jumlah beli melebihi stok yang tersedia!');
        }

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // Tampilkan Halaman Keranjang
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $totalHarga = 0;

        foreach ($cart as $id => $jumlah) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->harga * $jumlah;
                $totalHarga += $subtotal;

                $cartItems[] = [
                    'id' => $product->id_barang,
                    'nama' => $product->nama_barang,
                    'harga' => $product->harga,
                    'stok' => $product->stok,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.index', compact('cartItems', 'totalHarga'));
    }

    // Update Jumlah Barang (+ / -)
    public function updateCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $action = $request->input('action');

        if (isset($cart[$id])) {
            if ($action === 'plus') {
                // Validasi agar tidak melebih stok saat tombol + diklik
                if ($cart[$id] + 1 > $product->stok) {
                    return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia!');
                }
                $cart[$id]++;
            } elseif ($action === 'minus') {
                $cart[$id]--;
                if ($cart[$id] <= 0) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }

    // Hapus Item dari Keranjang
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show');
    }
}
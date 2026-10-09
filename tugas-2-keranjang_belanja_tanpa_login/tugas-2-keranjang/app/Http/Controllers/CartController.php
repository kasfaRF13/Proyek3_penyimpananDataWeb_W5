<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 1. Halaman Utama: Menampilkan Daftar Barang
    public function index()
    {
        $barangs = Barang::all();
        $cart = session()->get('cart', []);
        
        // Hitung total item yang ada di keranjang untuk badge di atas
        $totalItems = array_sum($cart);

        return view('index', compact('barangs', 'totalItems'));
    }

    // 2. Tambah Barang ke Keranjang
    public function addToCart($id)
    {
        $barang = Barang::findOrFail($id);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambah jumlahnya. Jika belum, set ke 1
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // 3. Halaman Keranjang Belanja
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $totalHarga = 0;

        // Ambil data nama & harga dari DB berdasarkan ID di session
        foreach ($cart as $id => $jumlah) {
            $barang = Barang::find($id);
            if ($barang) {
                $subtotal = $barang->harga * $jumlah;
                $totalHarga += $subtotal;

                $cartItems[] = [
                    'id' => $barang->id,
                    'nama' => $barang->nama,
                    'harga' => $barang->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('keranjang', compact('cartItems', 'totalHarga'));
    }

    // 4. Update Jumlah Barang (+ dan -)
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $action = $request->input('action'); // 'plus' atau 'minus'

        if (isset($cart[$id])) {
            if ($action === 'plus') {
                $cart[$id]++;
            } elseif ($action === 'minus') {
                $cart[$id]--;
                // Jika jumlah jadi 0, otomatis hapus item
                if ($cart[$id] <= 0) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }

    // 5. Hapus 1 Item
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show');
    }

    // 6. Kosongkan Keranjang
    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->route('cart.show');
    }
}
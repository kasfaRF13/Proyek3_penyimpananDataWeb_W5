<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // 1. Proses Checkout Transaksi
    public function checkout(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang kamu kosong!');
        }

        // Jalankan Database Transaction untuk keamanan transaksi
        DB::beginTransaction();

        try {
            $totalHarga = 0;
            $itemsToProcess = [];

            // Validasi ulang stok sebelum transaksi
            foreach ($cart as $id => $jumlah) {
                $product = Product::findOrFail($id);

                if ($jumlah > $product->stok) {
                    DB::rollBack();
                    return redirect()->route('cart.show')->with('error', "Stok {$product->nama_barang} tidak mencukupi!");
                }

                $subtotal = $product->harga * $jumlah;
                $totalHarga += $subtotal;

                $itemsToProcess[] = [
                    'product' => $product,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $product->harga
                ];
            }

            // Generate ID Order unik (misal: ORD-20261009-XXXX)
            $idOrder = 'ORD' . date('ymd') . rand(10, 99);

            // A. Simpan ke Tabel Orders
            Order::create([
                'id_order' => $idOrder,
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            // B. Simpan ke Tabel OrderDetails & Kurangi Stok Barang
            foreach ($itemsToProcess as $item) {
                OrderDetail::create([
                    'id_order' => $idOrder,
                    'id_barang' => $item['product']->id_barang,
                    'harga_satuan' => $item['harga_satuan'],
                    'jumlah_beli' => $item['jumlah'],
                ]);

                // Kurangi Stok
                $item['product']->decrement('stok', $item['jumlah']);
            }

            // Commit Transaksi
            DB::commit();

            // C. Kosongkan Keranjang Belanja
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Checkout berhasil! Pesanan kamu sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.show')->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    // 2. Tampilkan Daftar Riwayat Pesanan
    public function index()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)
                       ->orderBy('tanggal_order', 'desc')
                       ->get();

        return view('orders.index', compact('orders'));
    }

    // 3. Tampilkan Detail Pesanan Spesifik
    public function show($id)
    {
        $order = Order::where('id_order', $id)
                      ->where('id_user', Auth::user()->id_user)
                      ->firstOrFail();

        $details = OrderDetail::join('products', 'order_details.id_barang', '=', 'products.id_barang')
                              ->where('order_details.id_order', $id)
                              ->select('order_details.*', 'products.nama_barang')
                              ->get();

        return view('orders.show', compact('order', 'details'));
    }
}
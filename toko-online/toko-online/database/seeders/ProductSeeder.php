<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_barang' => 'BRG001', 'nama_barang' => 'Laptop Asus', 'deskripsi' => 'Laptop kerja', 'harga' => 7000000, 'stok' => 5, 'gambar' => 'laptop.jpg'],
            ['id_barang' => 'BRG002', 'nama_barang' => 'Mouse Wireless', 'deskripsi' => 'Mouse silent click', 'harga' => 150000, 'stok' => 15, 'gambar' => 'mouse.jpg'],
            ['id_barang' => 'BRG003', 'nama_barang' => 'Keyboard Mechanical', 'deskripsi' => 'Keyboard RGB', 'harga' => 450000, 'stok' => 10, 'gambar' => 'keyboard.jpg'],
            ['id_barang' => 'BRG004', 'nama_barang' => 'Headset Gaming', 'deskripsi' => 'Headset bass mantap', 'harga' => 300000, 'stok' => 8, 'gambar' => 'headset.jpg'],
            ['id_barang' => 'BRG005', 'nama_barang' => 'Monitor 24 Inch', 'deskripsi' => 'Monitor IPS 75Hz', 'harga' => 1500000, 'stok' => 0, 'gambar' => 'monitor.jpg'], // Stok 0
            ['id_barang' => 'BRG006', 'nama_barang' => 'Flashdisk 32GB', 'deskripsi' => 'USB 3.0 speed tinggi', 'harga' => 75000, 'stok' => 25, 'gambar' => 'flashdisk.jpg'],
            ['id_barang' => 'BRG007', 'nama_barang' => 'Webcam Full HD', 'deskripsi' => 'Webcam 1080p', 'harga' => 250000, 'stok' => 6, 'gambar' => 'webcam.jpg'],
            ['id_barang' => 'BRG008', 'nama_barang' => 'Speaker Bluetooth', 'deskripsi' => 'Speaker portable', 'harga' => 200000, 'stok' => 12, 'gambar' => 'speaker.jpg'],
            ['id_barang' => 'BRG009', 'nama_barang' => 'Powerbank 10000mAh', 'deskripsi' => 'Fast charging', 'harga' => 180000, 'stok' => 20, 'gambar' => 'powerbank.jpg'],
            ['id_barang' => 'BRG010', 'nama_barang' => 'Stand Laptop', 'deskripsi' => 'Bahan aluminium', 'harga' => 90000, 'stok' => 0, 'gambar' => 'stand.jpg'], // Stok 0
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
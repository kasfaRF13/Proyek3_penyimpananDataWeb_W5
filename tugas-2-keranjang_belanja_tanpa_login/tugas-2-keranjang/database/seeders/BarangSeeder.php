<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangList = [
            ['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 20],
            ['nama' => 'Pulpen', 'harga' => 3000, 'stok' => 50],
            ['nama' => 'Penggaris', 'harga' => 4000, 'stok' => 15],
            ['nama' => 'Pensil 2B', 'harga' => 2500, 'stok' => 30],
            ['nama' => 'Penghapus', 'harga' => 1500, 'stok' => 40],
        ];

        foreach ($barangList as $b) {
            Barang::create($b);
        }
    }
}

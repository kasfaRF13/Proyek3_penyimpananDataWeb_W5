<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang'; // menentukan nama tabel khusus
    protected $fillable = ['nama', 'harga', 'stok', 'gambar'];
}
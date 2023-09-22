<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barangs";
    protected $fillable = ['nama_barang','kategori','harga_beli','harga_jual','pajak','deskripsi','gambar','tahun_beli'];
}

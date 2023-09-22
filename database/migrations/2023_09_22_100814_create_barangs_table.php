<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->decimal('harga_beli', 12, 2); // Kolom harga_beli akan memiliki 10 digit total, dengan 2 digit di belakang koma.
            $table->decimal('harga_jual', 12, 2);
            $table->decimal('pajak', 12, 2);
            $table->text('deskripsi');
            $table->string('gambar');
            $table->integer('tahun_beli');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks'); // Foreign key ke tabel produks
            $table->longText('foto_produk'); // Foto produk dari tabel produks
            $table->string('nama_produk'); // Nama produk dari tabel produks
            $table->integer('kuantitas');
            $table->string('harga_produk'); // Harga produk dari tabel produks (string sesuai dengan harga di produks)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};

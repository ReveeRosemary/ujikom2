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
        Schema::create('toko_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('toko_id');
            $table->unsignedBigInteger('produk_id');
            $table->timestamps();

            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');

            $table->unique(['toko_id', 'produk_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko_produk');
    }
};

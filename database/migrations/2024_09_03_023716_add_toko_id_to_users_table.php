<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('toko_id')->nullable()->after('id'); // Menambahkan kolom 'toko_id' setelah kolom 'id'
            
            // Jika ada relasi dengan tabel lain, Anda bisa menambahkan foreign key seperti ini:
            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('toko_id');
        });
    }
    
};

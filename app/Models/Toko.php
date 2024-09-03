<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Toko extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function produks() {
        return $this->belongsToMany(Produk::class, 'toko_produk');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

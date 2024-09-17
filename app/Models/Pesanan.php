<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesanan';

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produk() {
        return $this->hasMany(Produk::class, 'produk_id', 'id');
    }
}
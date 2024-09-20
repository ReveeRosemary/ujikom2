<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'cart';

    public function produk() {
        return $this->hasMany(Produk::class, 'produk_id', 'id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}

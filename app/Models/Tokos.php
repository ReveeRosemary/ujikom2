<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokos extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'tokos';

    public function produks() {
        return $this->belongsToMany(Produk::class, 'toko_produk');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}

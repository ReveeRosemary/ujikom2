<?php

namespace App\Models;

use App\Models\Toko;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id', 'id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan; // Ensure this model is included
use App\Models\Cart; // Ensure this model is included
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // Get 6 random products for the bestseller carousel
        $bestsellerProducts = Produk::inRandomOrder()->limit(6)->get();
        
        // Get products sorted by creation date for new arrivals
        $newArrivals = Produk::orderBy('created_at', 'desc')->get();

        return view('index', compact('bestsellerProducts', 'newArrivals'));
    }

    public function show($id)
    {
        // Retrieve the product by ID along with related toko information
        $product = Produk::with('toko')->findOrFail($id);
    
        // Render the detail.blade.php view with the product data
        return view('detail', compact('product'));
    }   
}

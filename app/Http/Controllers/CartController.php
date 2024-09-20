<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\Pesanan;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->kuantitas * $item->harga_produk;
        });

        return view('cart', compact('cartItems', 'totalPrice'));
    }

public function addToCart(Request $request, $productId)
{
    // Validate the input quantity
    $request->validate([
        'kuantitas' => 'required|integer|min:1',
    ]);

    $kuantitas = $request->input('kuantitas');

    // Check if the product exists
    $product = Produk::findOrFail($productId);

    // Check if the requested quantity is available in stock
    if ($kuantitas > $product->stok) {
        return redirect()->back()->withErrors(['kuantitas' => 'The requested quantity exceeds available stock.']);
    }

    // Check if the item already exists in the cart
    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('produk_id', $productId)
                    ->first();

    if ($cartItem) {
        // Update existing cart item
        $cartItem->update([
            'kuantitas' => $kuantitas,
            'harga_produk' => $product->harga
        ]);
    } else {
        // Add new item to cart
        Cart::create([
            'user_id' => auth()->id(),
            'produk_id' => $productId,
            'foto_produk' => $product->foto,
            'nama_produk' => $product->nama_produk,
            'kuantitas' => $kuantitas,
            'harga_produk' => $product->harga
        ]);
    }

    // Decrement the stock of the product
    $product->stok -= $kuantitas;
    $product->save();

    return redirect()->route('cart.index');
}


    public function checkout()
    {
        // Get the current user's cart items
        $cartItems = Cart::where('user_id', auth()->id())->get();
    
        foreach ($cartItems as $item) {
            // Create a new order (pesanan) for each cart item
            Pesanan::create([
                'user_id' => auth()->id(),
                'produk_id' => $item->produk_id,
                'foto_produk' => $item->foto_produk,
                'nama_produk' => $item->nama_produk,
                'kuantitas' => $item->kuantitas,
                'harga_produk' => $item->harga_produk,
                'status' => 'Packaging' // Default status for new orders
            ]);
        }
    
        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();
    
        // Redirect or respond
        return redirect()->route('product.index')->with('success', 'Checkout successful');
    }
    

    public function destroy($id) {
        $cartItem = Cart::where('user_id', auth()->id())->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index');
    }
}

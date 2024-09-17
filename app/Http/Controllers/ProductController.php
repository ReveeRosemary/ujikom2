<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan; // Ensure this model is included
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
    
    public function pesanan(Request $request)
    {
        // Fetch the status from the request (e.g., 'Delivered', 'On The Way', etc.)
        $status = $request->input('status', 'Packaging'); // Default status is 'Packaging'

        // Retrieve orders for the logged-in user with the specified status
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', $status)
            ->get();

        // Pass orders and current status to the view
        return view('pesanan', compact('pesanan', 'status'));
    }

    public function cart()
    {
        // Retrieve cart items for the logged-in user
        $cartItems = Pesanan::where('user_id', Auth::id())->where('status', 'Cart')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->kuantitas * $item->harga_produk;
        });

        return view('cart', compact('cartItems', 'totalPrice'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Produk::findOrFail($id);
        $quantity = $request->input('kuantitas', 1);

        // Check if the quantity is valid
        if ($quantity < 1 || $quantity > $product->stok) {
            return redirect()->route('product.show', $id)->withErrors('Invalid quantity selected.');
        }

        // Add the product to the cart
        Pesanan::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'produk_id' => $product->id,
                'status' => 'Cart'
            ],
            [
                'foto_produk' => $product->foto,
                'nama_produk' => $product->nama_produk,
                'kuantitas' => $quantity,
                'harga_produk' => $product->harga
            ]
        );

        return redirect()->route('cart.index')->with('status', 'Product added to cart!');
    }

    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'kuantitas.*' => 'required|integer|min:1',
        ]);

        foreach ($validated['kuantitas'] as $itemId => $quantity) {
            $cartItem = Pesanan::where('user_id', Auth::id())
                ->where('produk_id', $itemId)
                ->where('status', 'Cart')
                ->first();
            
            if ($cartItem) {
                // Ensure the updated quantity does not exceed available stock
                $product = Produk::find($itemId);
                if ($quantity <= $product->stok) {
                    $cartItem->update(['kuantitas' => $quantity]);
                } else {
                    return redirect()->route('cart.index')->withErrors('Quantity exceeds available stock.');
                }
            }
        }

        return redirect()->route('cart.index')->with('status', 'Cart updated successfully!');
    }

    public function removeFromCart($id)
    {
        Pesanan::where('user_id', Auth::id())
            ->where('produk_id', $id)
            ->where('status', 'Cart')
            ->delete();

        return redirect()->route('cart.index')->with('status', 'Item removed from cart!');
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'kuantitas.*' => 'required|integer|min:1',
        ]);
    
        // Move cart items to orders
        foreach ($validated['kuantitas'] as $itemId => $quantity) {
            $cartItem = Pesanan::where('user_id', Auth::id())
                ->where('produk_id', $itemId)
                ->where('status', 'Cart')
                ->first();
    
            if ($cartItem) {
                // Create a new order from the cart item
                Pesanan::create([
                    'user_id' => Auth::id(),
                    'produk_id' => $cartItem->produk_id,
                    'foto_produk' => $cartItem->foto_produk,
                    'nama_produk' => $cartItem->nama_produk,
                    'kuantitas' => $quantity,
                    'harga_produk' => $cartItem->harga_produk,
                    'status' => 'Packaging' // Default status for a new order
                ]);
    
                // Remove the item from the cart
                $cartItem->delete();
            }
        }
    
        return redirect()->route('product.index')->with('status', 'Order placed successfully!');
    }    
}

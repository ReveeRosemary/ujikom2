<?php

namespace App\Http\Controllers;

use App\Models\Pesanan; // Assuming you have a Pesanan model
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Show pesanan page filtered by status
    public function index(Request $request)
    {
        // Get the status from the request or default to 'Packaging'
        $status = $request->query('status', 'Packaging');

        // Retrieve pesanan (orders) based on the status
        $pesanan = Pesanan::where('user_id', auth()->id())
                        ->where('status', $status)
                        ->get();

        return view('pesanan', compact('pesanan'));
    }
}

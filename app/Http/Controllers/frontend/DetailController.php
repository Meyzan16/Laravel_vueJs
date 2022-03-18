<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $product  = Product::with(['Gallaries', 'User'])->where('slug', $slug)->firstorfail();

        return view('frontend.pages_f.details', compact('product'));
    }

    public function add(Request $request, $id)
    {
        $data = [
            'product_id' => $id,
            'users_id' => Auth::user()->id,
        ];

        Cart::create($data);
        return redirect()->route('cart')->with('success', 'data ditambahkan di keranjang');

    }
}

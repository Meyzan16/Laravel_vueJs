<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::with(['product.gallaries','user'])->where('users_id', Auth::user()->id)->get();

        return view('frontend.pages_f.cart', compact('carts'));
    }

    public function delete(Request $request, $id){

        $cart = Cart::findorfail($id);

        $cart->delete();
        return redirect()->route('cart')->with('delete', 'data berhasil di hapus');

    }

    public function success(){
        return view('frontend.pages_f.success');
    }
}

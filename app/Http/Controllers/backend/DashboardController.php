<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\transaction_detail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $transaction = transaction_detail::with(['transaction.user', 'product.gallaries'])
                        ->whereHas('product' , function($product){
                            $product->where('users_id', Auth::user()->id);
                        });
        
                        //fungsi reduce menghitung
        $revenue = $transaction->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();

        return view('backend.pages_b.dashboard', [
            'transaction_count' => $transaction->count(),
            'transaction_data' => $transaction->get(),
            'revenue' => $revenue,
            'customer' => $customer,


        ]);
    }
}

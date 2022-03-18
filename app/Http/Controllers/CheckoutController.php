<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\transaction;
use App\Models\transaction_detail;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
// use Midtrans\Snap;
// use Midtrans\Config;


class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $kode_transaction = 'STORE-'.mt_rand(00000,99999);
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();

        //transaction create
        $transaction = transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => 0,
            'total_price' =>(int) $request->total_price,
            'transaction_status' => 'PENDING',
            'kode_transaction' => $kode_transaction,
        ]);

        foreach ($carts as $data) {
            $trx = 'TRX-'.mt_rand(00000,99999);

            transaction_detail::create([
                'transactions_id' => $transaction->id,
                'product_id' => $data->product->id,
                'price' => $data->product->price,
                'resi' =>   '',
                'shipping_status' => 'PENDING',
                'kode_transaction_detail' => $trx,
            ]);
        }

        //konfigurasi midtrans

        // // Set your Merchant Server Key
        // Config::$serverKey = config('services.midtrans.serverKey');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // Config::$isProduction = config('services.midtrans.isProduction');
        // // Set sanitization on (default)
        // Config::$isSanitized = config('services.midtrans.isSanitized');
        // // Set 3DS transaction for credit card to true
        // Config::$is3ds = config('services.midtrans.is3ds');

        \Midtrans\Config::$serverKey = 'Mid-server-RwOC3nQcAAkLTXUsXs02NgaV';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        //buat array untuk di kirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $kode_transaction,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enable_payments' => [
                'gopay', 'bank_transfer' , 'permata_va'
            ],
            'vtweb' => []
        ];

        

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans)->redirect_url;
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
          catch (Exception $e) {
            echo $e->getMessage();
          }


    }

    public function callback(Request $request){

    }
}

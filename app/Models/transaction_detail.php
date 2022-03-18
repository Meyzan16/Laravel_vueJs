<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Transaction;


class transaction_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactions_id',
        'product_id',
        'price',
        'resi',
        'shipping_status',
        'kode_transaction_detail'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function transaction(){
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}

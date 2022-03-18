<?php

namespace App\Models;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = [
        'product_id', 'users_id'
    ];

    public function product(){
        //setiap item cart mempunyai 1 product
        return $this->belongsTo(product::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}

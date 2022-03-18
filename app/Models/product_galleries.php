<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class product_galleries extends Model
{
    use HasFactory;

    protected $fillable = [
        'photos',
        'products_id',
    ];

    protected $hidden =[];

    //satu prodak mempunyai banyak foto
    public function product()
    {                                            
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    
}

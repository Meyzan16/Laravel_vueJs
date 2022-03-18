<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\product_galleries;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'users_id',
        'categories_id',
        'price',
        'description',
        'slug'
    ];

    protected $hidden =[];

    //satu prodak mempunyai banyak foto
    public function gallaries()
    {                                            
        return $this->hasMany(Product_galleries::class, 'products_id' , 'id');
    }

    //product ini dibuat oleh siapa
    public function user()
    {                                      //primarykey    //foreignkey
        return $this->hasOne(User::class, 'id' , 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id' );
    }

    public function cart()
    {
        return  $this->hasOne(Product::class);
    }







}

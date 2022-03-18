<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        //latest product terakhir atau sort_bydate
        $categories = Category::take(6)->get();
        $products = Product::with(['Gallaries'])->take(8)->get();

        return view('frontend.pages_f.home', [
            'categories' => $categories,
            'products'=> $products
        ]);
    }

    
}

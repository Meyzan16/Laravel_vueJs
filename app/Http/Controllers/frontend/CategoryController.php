<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        //latest product terakhir atau sort_bydate
        $categories = Category::all();
        $products = Product::with(['Gallaries'])->paginate(16);

        return view('frontend.pages_f.category', [
            'categories' => $categories,
            'products'=> $products
        ]); 
    }

    public function detail(Request $request, $slug)
    {
        //latest product terakhir atau sort_bydate
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['Gallaries'])->where('categories_id', $category->id)->paginate(16);

        return view('frontend.pages_f.category', [
            'categories' => $categories,
            'products'=> $products
        ]); 
    }
}

<?php

namespace App\Http\Controllers\backend\Admin;
use  App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\product_galleries;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Elequent\SoftDeletes;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\ProductGalleryRequest;

class ProductGalleryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
        if(request()->ajax())
        {
            //withTrashed
            
            $query = product_galleries::with(['product']);

            //kita kembalikan data dalam bentuk json
            return Datatables::of($query)
            ->addColumn('action', function($item){
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <form action="'.route('product-gallery.destroy', $item->id).'" method="POST" >
                                    '.method_field('delete'). csrf_field() .'
                                    <button type="submit" class="dropdown-item text-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->editColumn('photos', function($item) {
                //link kan dulu storage nya php artisan storage:link
                //jika ada photo nya disisi, dan diambil dari storage jika tidak ada dikosongkan
                return $item->photos ? '<img src="'.Storage::url($item->photos).'" style="max-height: 40px;" /> ' : ''; 
            })
            ->rawColumns([
                'action','photos'
            ])
            ->make() ;
        }

                return \view('backend.admin.product-gallery.index');
        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $product = Product::all();
        return \view('backend.admin.product-gallery.create',[
            'products' => $product
        ]);
    }

    
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
    
        product_galleries::create($data);

        return \redirect()->route('product-gallery.index');
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $query = Product::findorfail($id);
        $users = User::all();
        $category = Category::all();

        return \view('backend.admin.product.edit',
        [   
            'item'=>$query,
            'users' => $users,
            'categories' => $category
        ]
    );
    }

    
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
         
        $item = Product::findOrfail($id);

        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('product.index');
    }

    
    public function destroy($id)
    {
        $item = product_galleries::findorfail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}

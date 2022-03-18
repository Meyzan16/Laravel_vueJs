<?php

namespace App\Http\Controllers\backend\Admin;
use  App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Elequent\SoftDeletes;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\ProductRequest;

class ProductAdminController extends Controller
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
            
            $query = Product::with(['user', 'category']);

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
                                <a class="dropdown-item" href="'.route('product.edit', $item->id ).'"> Edit </a>
                                <form action="'.route('product.destroy', $item->id).'" method="POST" >
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
            ->rawColumns([
                'action'
            ])
            ->make() ;
        }

                return \view('backend.admin.product.index');
        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $category = Category::all();
        return \view('backend.admin.product.create',[
            'users' => $users,
            'categories' => $category
        ]);
    }

    
    public function store(ProductRequest $request)
    {
        $data = $request->all();


        $data['slug'] = Str::slug($request->name);
    
        Product::create($data);

        return \redirect()->route('product.index');
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
        $item = Product::findorfail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}

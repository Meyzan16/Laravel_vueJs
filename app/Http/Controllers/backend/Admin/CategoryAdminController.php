<?php

namespace App\Http\Controllers\backend\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Elequent\SoftDeletes;

use Illuminate\Support\Str;

use App\Http\Requests\Admin\CategoryAdminRequest;


class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //memanggil request ajax
        if(request()->ajax())
        {
            
            $query = Category::query();

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
                                <a class="dropdown-item" href="'.route('category.edit', $item->id ).'"> Edit </a>
                                <form action="'.route('category.destroy', $item->id).'" method="POST" >
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
            ->editColumn('photo', function($item) {
                //link kan dulu storage nya php artisan storage:link
                //jika ada photo nya disisi, dan diambil dari storage jika tidak ada dikosongkan
                return $item->photo ? '<img src="'.Storage::url($item->photo).'" style="max-height: 40px;" /> ' : ''; 
            })
            ->rawColumns([
                'action','photo'
            ])
            ->make() ;
        }

        return \view('backend.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return \view('backend.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAdminRequest $request)
    {
        //sebelum di ambil request di jalankan dulu rules nya di categoryAdminrequst
        $data = $request->all();

        $rand_slug = Str::slug(rand(5,100).'_'.$request->name);
        $data['slug'] = $rand_slug; //name itu yang kolom di database
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        Category::create($data);

        return \redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //findorfail jika data tidak ada, kembalikan 404
        $item = Category::findorfail($id);

        return \view('backend.admin.category.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAdminRequest $request, $id)
    {
        $data = $request->all();

        $rand_slug = Str::slug(rand(5,100).'_'.$request->name);
        $data['slug'] = $rand_slug; //name itu yang kolom di database
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        //diambil dulu
        $item = Category::findorfail($id);
        $item->update($data);

        return \redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findorfail($id);
        $item->delete($item);

        return redirect()->route('category.index');
    }
}

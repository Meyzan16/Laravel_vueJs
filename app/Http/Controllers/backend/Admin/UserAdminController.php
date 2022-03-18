<?php

namespace App\Http\Controllers\backend\Admin;
use  App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Elequent\SoftDeletes;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\UserRequest;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //memanggil request ajax
        //  if(request()->ajax())
        //  {
             
             $query = User::all();
 
        //      //kita kembalikan data dalam bentuk json
        //      return Datatables::of($query)->addColumn('action', function($item){
        //          return '
        //              <div class="btn-group">
        //                  <div class="dropdown">
        //                      <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
        //                          Aksi
        //                      </button>
        //                      <div class="dropdown-menu">
        //                          <a class="dropdown-item" href="'.route('user.edit', $item->id ).'"> Edit </a>
        //                          <form action="'.route('user.destroy', $item->id).'" method="POST" >
        //                              '.method_field('delete'). csrf_field() .'
        //                              <button type="submit" class="dropdown-item text-danger">
        //                                  Hapus
        //                              </button>
        //                          </form>
        //                      </div>
        //                  </div>
        //              </div>
        //          ';
        //      })
            
        //      ->rawColumns([
        //          'action'
        //      ])
        //      ->make() ;
        //  }
 
                return \view('backend.admin.user.index', [
                    'user' => $query
                ]);
        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();


        $data['password'] = \bcrypt($request->password);
    
        User::create($data);

        return \redirect()->route('user.index');
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
        $query = User::findorfail($id);
        
        return \view('backend.admin.user.edit',['item'=>$query]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:50'
        ];
        
        //kalo email di database idak samo dengan request bearti berbeda maka kasih validasi
        if($request->input('email') != $user->email ){
            $rules['email'] = 'required|email:dns|unique:users';
        }

        //ambil semua request
        $data = $request->validate($rules);

        //jika password lama berbeda dengan password baru maka di ganti password nya
        if($request->input('password')){
            $data['password'] = \bcrypt($request->input('password'));
        }else{
            unset($rules['password']);
        }

        
       
        $item = User::findorfail($user->id);
        $item->update($data);
        return \redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findorfail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}

<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index(){

        $categories = Category::all();
        return \view('login.register', compact('categories'));
    }

    public function success(request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'store_name' => 'nullable|string|max:255',
            'categories_id' => 'nullable|integer|exists:categories_id',
            'is_store_open' => 'required'
        ];
    
        //pasang pesan kesalahan
        $messages = [
            'email.required'     => 'Form Email wajib diisi',
            'password.required'     => 'Form password wajib diisi',
        ];
    
        //ambil semua request dan pasang rules dan isi pesanya
        $validator = Validator::make($request->all(), $rules, $messages);
        //jika rules tidak sesuai kembalikan ke login bawak pesan error dan bawak request nya agar bisa dipakai denga old di view
        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_name' =>  isset($request->store_name) ? $request->store_name : NULL,
            'categories_id' => isset($request->categories_id) ? $request->categories_id : NULL,
            'store_status' => isset($request->is_store_open) ? 1 : 0,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil terdaftar');
    }

    public function check(request $request)
    {
        return  User::where('email', $request->email)->count() > 0 ? 'Unavailable' : 'Available';
    }

    
}

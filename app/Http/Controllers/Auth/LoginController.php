<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return \view('login.login');
    }

    public function authenticate(Request $request)
    {

        //pasang rules
    $rules = [
        'email' => 'required',
        'password'=> 'required'
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

        //jika berhasil jalankan script berrikut
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if (Auth::check()) {
                $request->session()->regenerate();
                return \redirect()->route('home');
            }
        }else{
            return back()->with('loginerror', 'Usernama dan password salah');
        }
    }

    public function logout(request $request){
        Auth::logout();
        //invalid session supaya tidak bisa dipakai
        $request->session()->flush();
        $request->session()->invalidate();
        //bikin token baru supaya tidak dibajak
        $request->session()->regenerateToken();
        //redirect ke halaman mana
        return \redirect()->route('home');
    }
}

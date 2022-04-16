<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class AuthController extends Controller
{
    public function loginadmin()
    {
        return view('admin.pages.auth.loginadmin');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect(route('adminebonpinjam'));
        }
        return back()->with('pesan','E-mail atau Kata Sandi Anda Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect ('/e-bonpinjam/loginadmin');
    }

    
}

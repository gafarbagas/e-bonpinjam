<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Masyarakat;
use App\Mail\LupaPassword;
use Carbon\Carbon;
use Alert;
use DB;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::guard('masyarakat')->check()){
            return redirect('/');
        }
        return view('user.auth.loginuser');
    }

    public function loginproses(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('masyarakat')->attempt($credentials)){
            return redirect(route('userebonpinjam'));
        }
        return back()->with('pesan', 'E-mail atau Kata Sandi Anda Salah');
    }

    public function create()
    {
        
        return view('user.auth.registrasi');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_masyarakat' => 'required|max:255',
            'nik_masyarakat' => 'required|max:255|unique:masyarakats,nik_masyarakat',
            'alamat' => 'required|max:1000',
            'email' => 'required|max:255|unique:masyarakats,email',
            'password' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan',
        ];

        $attributeName = [
            'nik_masyarakat' => 'NIK',
            'email' => 'E-Mail',
        ];
        
        $this->validate($request, $rules, $customMessage, $attributeName);

        $masyarakat = Masyarakat::create([
            'nama_masyarakat' => $request->nama_masyarakat,
            'nik_masyarakat' => $request->nik_masyarakat,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Berhasil','Selamat, akun Anda berhasil dibuat. Silahkan login');
        return redirect('/e-bonpinjam');
    }

    public function lupapassword()
    {
        return view ('user.auth.lupapassword');
    }

    public function lupapasswordpost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:masyarakats',
        ]);

        $email = $request->email;
        $masyarakat = Masyarakat::where('email', $email)->first();
        $namaMasyarakat = $masyarakat->nama_masyarakat;
        $token = Str::random(60);


        DB::table('password_resets')->insert(
            ['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($email)->send(new LupaPassword($email, $token, $namaMasyarakat));

        Alert::info('','Kami telah mengirimkan link ubah password ke E-Mail Anda');
        return redirect('/e-bonpinjam/lupapassword');
    }

    public function getPassword($token) {

        return view('user.auth.gantipassword', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:masyarakats',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

            $user = Masyarakat::where('email', $request->email)
                        ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            Alert::success('Berhasil','Password anda berhasil diubah');
            return redirect('/e-bonpinjam');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        return redirect ('/e-bonpinjam');
    }

}

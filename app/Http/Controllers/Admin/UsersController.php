<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;
use Alert;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role_id',[1,2])->get();
        return view('admin.pages.pengguna.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view ('admin.pages.pengguna.create', ['role_name' => $roles]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];
        
        $this->validate($request, $rules, $customMessage);

        User::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Sukses','Data Berhasil Ditambah');
        return redirect('/e-bonpinjam/admin/pengguna');
    }

    public function edit($id)
    {
        $userID = Crypt::decrypt($id);
        $user = User::find($userID);
        return view ('admin.pages.pengguna.edit', compact('user'));
        
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [
            'name' => 'required|max:255',
            'role_id' => 'required|',
            'email' => "required|max:255|unique:users,email,$id",
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];
        
        $this->validate($request, $rules, $customMessage);
        $user->update([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
        ]);
        Alert::success('','Data Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/pengguna');
    }

    public function editpasswordform($id){
        $userID = Crypt::decrypt($id);
        $user = User::find($userID);
        return view('admin.pages.pengguna.resetpassword', ['user' => $user]);
    }

    public function editpassword(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'newpassword' => 'required|max:255'
        ]);
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();
        Alert::success('','Password Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/pengguna');
    }

    public function destroy($id)
    {
        $userID = Crypt::decrypt($id);
        User::destroy($userID);
        Alert::success('','Data Berhasil Dihapus');
        return redirect('/e-bonpinjam/admin/pengguna');
        
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jaksa;
use Auth;
use Alert;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view ('admin.pages.profil.profile', array('user'=> Auth::user()));
    }

    public function edit()
    {
        return view ('admin.pages.profil.editprofile', array('user'=> Auth::user()));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $avatar->getClientOriginalName();
            Image::make($avatar)->fit(300,300)->save( public_path('/img/profile/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        $userID = $user->id;
        $jaksaID = Jaksa::where('user_id', $userID)->update([
            'nama_jaksa' => $request->name,
        ]);

        toast('Profil Berhasil Diubah','success');
        return redirect('/e-bonpinjam/admin/adminprofil');
    }

    public function ubahkatasandi()
    {
        return view ('admin.pages.profil.editpassword', array('user'=> Auth::user()));
    }

    public function updatePassword(Request $request){
        $user = Auth::user();
        $request->validate([
            'newpassword' => 'required|max:255'
        ]);
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();
        Alert::success('','Password Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/adminprofil');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Masyarakat;

use Auth;
use Alert;
use Image;


class ProfilMasyarakatController extends Controller
{
    public function index()
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;

        return view('user.pages.profil.profil',compact('user'));
    }

    public function edit()
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;

        return view('user.pages.profil.editprofil',array('user'=> Auth::user()));
    }

    public function update(Request $request, $id)
    {
        $user = Masyarakat::find($id);

        $rules = [
            'nama_masyarakat' => 'required|max:255',
            'alamat' => 'required|max:1000',
            'email' => "required|max:255|unique:masyarakats,email,$id",
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'email' => 'E-Mail',
        ];
        
        $this->validate($request, $rules, $customMessage, $attributeName);
        
        $user->update([
            'nama_masyarakat' => $request->nama_masyarakat,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);
        
        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'required|image|max:2048',
            ]);
            if ($user->avatar !== 'default.png'){
                $usersImage = public_path("/img/profile/{$user->avatar}");
                if (File::exists($usersImage)) {
                    unlink($usersImage);
                }
            }
            $avatar = $request->file('avatar');
            $filename = $avatar->getClientOriginalName();
            Image::make($avatar)->fit(300,300)->save( public_path('/img/profile/' . $filename));

            $user->avatar = $filename;
            $user->save();
        }

        if($request->hasFile('foto_ktp')){
            $request->validate([
                'foto_ktp' => 'required|image|max:2048',
            ]);
            $avatar = $request->file('foto_ktp');
            $filename = $avatar->getClientOriginalName();
            $img = Image::make($avatar)->resize(300, NULL, function($constraint){
                $constraint->aspectRatio();
            });
            $img->save( public_path('/img/foto_ktp/' . $filename));

            $user = Auth::user();
            $user->foto_ktp = $filename;
            $user->save();
        }

        Alert::success('','Profil Berhasil Diubah');
            return redirect('/e-bonpinjam/user/profil');
    }

    public function editpassword()
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;

        return view('user.pages.profil.editpassword',array('user'=> Auth::user()));
    }

    public function updatepassword(Request $request)
    {

        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))){
            toast('Kata Sandi Tidak Cocok','error');
            return back();
        }
        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){
            toast('Kata Sandi Tidak Boleh Sama','error');
            return back();
        }
        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required'
        ]);
        $user=Auth::user();
        $user->password = Hash::make($request->get('newpassword'));
        $user->save();
        Alert::success('','Profil Berhasil Diubah');
        return redirect('/e-bonpinjam/user/profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

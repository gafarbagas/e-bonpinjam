<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Jaksa;
use App\User;
Use Alert;



class JaksasController extends Controller
{
    public function index()
    {
        $jaksas = Jaksa::all();
        return view('admin.pages.jaksa.index', ['jaksas' =>$jaksas->sortByDesc('id')->all()]);
    }

    public function create()
    {
        return view ('admin.pages.jaksa.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nrp_jaksa' => 'required|max:255|unique:jaksas,nrp_jaksa',
            'nama_jaksa' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'pangkat' => 'required|max:255',
            'email'=> 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'nrp_jaksa' => 'NRP Jaksa'
        ];
        
        $this->validate($request, $rules, $customMessage, $attributeName);

        $user = User::create([
            'name' => $request->nama_jaksa,
            'role_id' => 3,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        $user_id = $user->id;
        Jaksa::create([
            'nrp_jaksa' => $request->nrp_jaksa,
            'nama_jaksa' => $request->nama_jaksa,
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'user_id' => $user_id,
        ]);
        Alert::success('Sukses','Data Jaksa Berhasil Ditambah');
        return redirect('/e-bonpinjam/admin/jaksa');
    }

    public function edit($id)
    {
        $jaksaID = Crypt::decrypt($id);
        $jaksa = Jaksa::find($jaksaID);
        return view ('admin.pages.jaksa.edit', compact('jaksa'));
    }

    public function update(Request $request, Jaksa $jaksa)
    {
        $rules = [
            // 'nrp_jaksa' => 'required|max:255|unique:jaksas,nrp_jaksa',
            'nama_jaksa' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'pangkat' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        // $attributeName = [
        //     'nrp_jaksa' => 'NRP Jaksa'
        // ];

        $this->validate($request, $rules, $customMessage);

        Jaksa::where('id', $jaksa->id)
            ->update([
                // 'nrp_jaksa' => $request->nrp_jaksa,
                'nama_jaksa' => $request->nama_jaksa,
                'jabatan' => $request->jabatan,
                'pangkat' => $request->pangkat,
            ]);
        User::where('id',$jaksa->user_id)
            ->update([
                'name' => $request->nama_jaksa,
                'email' => $request->email
            ]);
        Alert::info('','Data Jaksa Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/jaksa');
    }

    public function destroy($id)
    {
        $jaksaID = Crypt::decrypt($id);
        Jaksa::destroy($jaksaID);
        Alert::success('','Data Jaksa Telah Dihapus');
        return redirect('/e-bonpinjam/admin/jaksa');
    }
}
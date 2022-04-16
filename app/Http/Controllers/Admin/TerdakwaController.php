<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Barangbukti;
use App\Keluarga;
use App\Kategori;
use App\Jaksa;
use App\Terdakwa;
use Carbon\Carbon;
use Alert;

class TerdakwaController extends Controller
{
    public function index()
    {
        $terdakwas = Terdakwa::all();
        return view('admin.pages.terdakwa.index',['terdakwas' => $terdakwas->sortByDesc('id')->all()]);
    }

    public function create()
    {
        $kategori = Kategori::where('id',2)->first();
        $tanggal = Carbon::now()->format('Y-m-d');
        $terdakwa = Terdakwa::whereDate('created_at', '=', $tanggal)->get();
        $countTerdakwa = count($terdakwa)+1;
        if ($countTerdakwa < 10) {
            $kodeTerdakwa = $kategori->kode_kategori."-".date('dmy')."000".$countTerdakwa;
        }elseif ($countTerdakwa >= 10 && $countTerdakwa <=99) {
            $kodeTerdakwa = date('dmy')."00".$countTerdakwa;
        }elseif ($countTerdakwa >= 100) {
            $kodeTerdakwa = date('dmy')."0".$countTerdakwa;
        }else{
            $kodeTerdakwa = date('dmy').$countTerdakwa;
        }

        return view('admin.pages.terdakwa.create', compact('kodeTerdakwa'));
        
    }

    public function store(Request $request)
    {
        $rules = [
            'kode_terdakwa' => 'required|max:255|unique:terdakwas,kode_terdakwa',
            'jaksa_id' => 'required',
            'nik_terdakwa' => 'required|max:255|unique:terdakwas,nik_terdakwa',
            'nama_terdakwa' => 'required|max:255',
            'keluarga_id' => 'required',
            'orangtua_terdakwa' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'agama_id' => 'required',
            'alamat_terdakwa' => 'required|max:255',
            'pekerjaan_terdakwa' => 'required|max:255',
            'kewarganegaraan_id' => 'required',
            'pendidikan_id' => 'required',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'nik_terdakwa' => 'NIK'
        ];
        
        $this->validate($request, $rules, $customMessage, $attributeName);
        
        Terdakwa::create($request->all());
        
        Alert::success('Sukses','Data Terdakwa di Tambah');
        return redirect('/e-bonpinjam/admin/terdakwa');
    }

    public function edit($id)
    {
        $terdakwaID = Crypt::decrypt($id);
        $terdakwa = Terdakwa::find($terdakwaID);
        return view('admin.pages.terdakwa.edit', ['terdakwa' => $terdakwa]);
    }

    public function update(Request $request, Terdakwa $terdakwa)
    {
        Terdakwa::where('id', $terdakwa->id)
            ->update([
                'kode_terdakwa' => $request->kode_terdakwa,
                'jaksa_id' => $request->jaksa_id,
                'nik_terdakwa' => $request->nik_terdakwa,
                'nama_terdakwa' => $request->nama_terdakwa,
                'keluarga_id' => $request->keluarga_id,
                'orangtua_terdakwa' => $request->orangtua_terdakwa,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama_id' => $request->agama_id,
                'alamat_terdakwa' => $request->alamat_terdakwa,
                'pekerjaan_terdakwa' => $request->pekerjaan_terdakwa,
                'kewarganegaraan_id' => $request->kewarganegaraan_id,
                'pendidikan_id' => $request->pendidikan_id,
            ]);
            // toast('Data Berhasil Diubah','success');
        Alert::info('','Data Terdakwa Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/terdakwa');
    }

    public function destroy($id)
    {
        $terdakwaID = Crypt::decrypt($id);
        Terdakwa::destroy($terdakwaID);
        Alert::success('','Data Terdakwa Telah di Hapus');
        return redirect('/e-bonpinjam/admin/terdakwa');
    }
}

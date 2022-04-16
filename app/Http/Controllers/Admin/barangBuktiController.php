<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Barangbukti;
use App\Kategori;
use Carbon\Carbon;
use Alert;

class barangBuktiController extends Controller
{
    public function index()
    {
        $barangbuktis = Barangbukti::all();
        return view('admin.pages.barangbukti.index',['barangbuktis'=>$barangbuktis->sortByDesc('id')->all()]);
    }

    public function create(Request $request)
    {
        $kategori = Kategori::where('id',3)->first();
        $tanggal = Carbon::now()->format('Y-m-d');
        $barangBukti = Barangbukti::whereDate('created_at', '=', $tanggal)->get();
        $countBarangBukti = count($barangBukti)+1;
        if ($countBarangBukti < 10) {
            $kodeBarangBukti = $kategori->kode_kategori."-".date('dmy')."000".$countBarangBukti;
        }elseif ($countBarangBukti >= 10 && $countBarangBukti <=99) {
            $kodeBarangBukti = date('dmy')."00".$countBarangBukti;
        }elseif ($countBarangBukti >= 100) {
            $kodeBarangBukti = date('dmy')."0".$countBarangBukti;
        }else{
            $kodeBarangBukti = date('dmy').$countBarangBukti;
        }

        return view ('admin.pages.barangbukti.create',compact('kodeBarangBukti'));
    }

    public function store(Request $request)
    {
        $rules = [
            'terdakwa_id' => 'required',
            'status_id' => 'required',
            'kode_barangbukti' => 'required|max:255|unique:barang_buktis,kode_barangbukti',
            'nama_barangbukti' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];
        
        $this->validate($request, $rules, $customMessage);

        BarangBukti::create($request->all());
        
        Alert::success('Sukses','Data Barang Bukti Ditambah');
        return redirect('/e-bonpinjam/admin/barangbukti');
    }

    public function edit($id)
    {
        $barangbuktiID = Crypt::decrypt($id);
        $barangbukti = Barangbukti::find($barangbuktiID);
        return view ('admin.pages.barangbukti.edit',compact('barangbukti'));
    }

    public function update(Request $request, Barangbukti $barangbukti)
    {
        Barangbukti::where('id', $barangbukti->id)
            ->update([
                'nama_barangbukti' => $request->nama_barangbukti,
                'status_id' => $request->status_id,
            ]);
        Alert::info('','Data Barang Bukti Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/barangbukti');
    }

    public function destroy($id)
    {
        $barangbuktiID = Crypt::decrypt($id);
        Barangbukti::destroy($barangbuktiID);
        Alert::success('','Data barangbukti Telah Dihapus');
        return redirect('/e-bonpinjam/admin/barangbukti');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BatasPinjam;
use App\Kategori;
use Alert;

class dataMasterController extends Controller
{
    public function index()
    {
        $batasPinjam = BatasPinjam::all();
        $kategori = Kategori::all();
        return view('admin.pages.datamaster.index',compact('batasPinjam','kategori'));
    }

    public function bataswaktu($id, Request $request)
    {
        BatasPinjam::where('id', $id)
            ->update([
                'batas_pinjam' => $request->batas_pinjam,
            ]);
        Alert::info('','Data Batas Waktu Proses Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/datamaster');
    }

    public function kategori($id, Request $request)
    {
        Kategori::where('id', $id)
            ->update([
                'nama_kategori' => $request->nama_kategori,
                'kode_kategori' => $request->kode_kategori,
            ]);
        Alert::info('','Data Kategori Berhasil Diubah');
        return redirect('/e-bonpinjam/admin/datamaster');
    }
}

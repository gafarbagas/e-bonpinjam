<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Barangbukti;
use App\BatasPinjam;
use App\Kategori;
use App\Jaksa;
use App\Peminjaman;
use App\PinjamBarbuk;
use App\Terdakwa;
use App\User;
use App\Mail\KonfirmasiPeminjamanMail;
use App\Mail\AdminKonfirmasiPeminjamanMail;
use Carbon\Carbon;
use Alert;
use Auth;
use Image;
use Mail;
use PDF;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $jaksa = Jaksa::where('user_id',$userId)->first();
        
        if($jaksa)
        {
            $idJaksa = $jaksa->id;
            $terdakwa = Terdakwa::where('jaksa_id', $idJaksa)->count();
            
            if($terdakwa > 0)
            {
                $terdakwa = Terdakwa::where('jaksa_id', $idJaksa)->get();

                foreach($terdakwa as $index => $terdakwas){
                    $idTerdakwa[$index] = $terdakwas['id'];
                    $peminjamans[$index] = Peminjaman::whereIn('status_peminjaman_id',[2,3,4,5])
                                                        ->where('terdakwa_id', $idTerdakwa[$index])->get();
                }

                foreach($peminjamans as $i){
                    foreach($i as $value){
                        $peminjaman[] = $value;
                    }
                }

                if( empty($peminjaman) )
                {
                    $peminjaman = [];
                    return view('admin.pages.peminjaman.index',['peminjamans' => $peminjaman]);
                }
                else{
                    $peminjaman = collect($peminjaman)->sortBy('id')->reverse()->values();
                    return view('admin.pages.peminjaman.index',['peminjamans' => $peminjaman]);
                }
            }
            else
            {
                $peminjaman = [];
                return view('admin.pages.peminjaman.index',['peminjamans' => $peminjaman]);
            }
        }
        else
        {
            $peminjaman = Peminjaman::all();
            return view('admin.pages.peminjaman.index',['peminjamans' => $peminjaman->sortByDesc('id')->all()]);
        }
        
    }

    public function create()
    {
        $kategori = Kategori::where('id',1)->first();
        $tanggal = Carbon::now()->format('Y-m-d');
        $peminjaman = Peminjaman::where('tgl_peminjaman',$tanggal)->get();
        
        // $lastnumb = substr($peminjaman->kode_peminjaman, -4);
        // $numb = (int)$lastnumb;
        // $numb +=1;
        // $countPeminjaman = substr($numb, -4);

        $countPeminjaman = count($peminjaman)+1;
        if ($countPeminjaman < 10) {
            $kodePeminjaman = $kategori->kode_kategori."-".date('dmy')."000".$countPeminjaman;
        }elseif ($countPeminjaman >= 10 && $countPeminjaman <=99) {
            $kodePeminjaman = $kategori->kode_kategori."-".date('dmy')."00".$countPeminjaman;
        }elseif ($countPeminjaman >= 100) {
            $kodePeminjaman = $kategori->kode_kategori."-".date('dmy')."0".$countPeminjaman;
        }else{
            $kodePeminjaman = $kategori->kode_kategori."-".date('dmy').$countPeminjaman;
        }

        return view('admin.pages.peminjaman.create', compact('kodePeminjaman'));
    }

    public function ambildata(Request $request){
        $cek = Terdakwa::where('nama_terdakwa',$request->nama_terdakwa)
                        ->where('keluarga_id',$request->keluarga_id)
                        ->where('orangtua_terdakwa',$request->orangtua_terdakwa)
                        ->where('tkp_desa',$request->tkp_desa)
                        ->where('tkp_kecamatan',$request->tkp_kecamatan)
                        ->count();
        
        if($cek === 1){
            $ambildata = Terdakwa::where('nama_terdakwa',$request->nama_terdakwa)
                                    ->where('keluarga_id',$request->keluarga_id)
                                    ->where('orangtua_terdakwa',$request->orangtua_terdakwa)
                                    ->where('tkp_desa',$request->tkp_desa)
                                    ->where('tkp_kecamatan',$request->tkp_kecamatan)
                                    ->first();

            $bb = Barangbukti::where('terdakwa_id',$ambildata->id)->where('status_id',1)->get();
            return view('admin.pages.peminjaman.ambildata', compact('ambildata','bb'));
        }
        else{
            return response()->json([
                'success' => false,
            ]);
        };
    }

    public function store(Request $request)
    {
        $rules = [
            'terdakwa_id' => 'required',
            'barang_bukti_id' => 'required|array',
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];
        
        $this->validate($request, $rules, $customMessage);
        
        DB::beginTransaction();
        try{
            $batas = BatasPinjam::select('batas_pinjam')->where('id',1)->first();
            $value = $batas->batas_pinjam;
            $tglAkhir = Carbon::parse($request->tgl_peminjaman)->addDays($value);
            $tglPeminjaman = Carbon::now()->format('Y-m-d');

            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => $request->kode_peminjaman,
                'nama_peminjam' => $request->nama_peminjam,
                'nik_peminjam' => $request->nik_peminjam,
                'tgl_peminjaman' => $tglPeminjaman,
                'alamat_peminjam' => $request->alamat_peminjam,
                'terdakwa_id' => $request->terdakwa_id,
                'barang_bukti_id' => $request->barang_bukti_id,
                'tgl_akhir' => $tglAkhir,
            ]);
            foreach($request->barang_bukti_id as $barbuk)
            {
                $barbuk = PinjamBarbuk::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_bukti_id' => $barbuk
                ]);
            }

        }catch(\Throwable $th)
        {
            DB::rollback();
            throw $th;
        }
        DB::commit();

        return response()->json(
            [
                'success' => true,
                'message' => 'Peminjaman Telah Diajukan'
            ]
        );
        
    }

    public function konfirmasi($id)
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjaman = Peminjaman::find($peminjamanID);
        return view('admin.pages.peminjaman.konfirmasi', compact('peminjaman'));
    }

    public function postkonfirmasi(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'keterangan_peminjaman' => 'required|max:255',
            'status_peminjaman_id' => 'required',
        ]);
        
        $statusPeminjamanID = $request->status_peminjaman_id;

        $day = date('Y-m-d H:i:s');

        if ($statusPeminjamanID === '2')
        {
            $request->validate([
                'persetujuan_admin' => 'required|mimes:pdf|max:2048',
                'foto_ktp_peminjam' => 'required|image|max:2048',
            ]);

            if($request->hasFile('foto_ktp_peminjam')){
                $foto_ktp_peminjam = $request->file('foto_ktp_peminjam');
                $filenameKTP = $foto_ktp_peminjam->getClientOriginalName();
                $img = Image::make($foto_ktp_peminjam)->resize(300, NULL, function($constraint){
                    $constraint->aspectRatio();
                });
                $img->save(public_path('/document/' . $filenameKTP));
            }

            $filenamePersetujuanAdmin = $request->persetujuan_admin->getClientOriginalName();
            $request->persetujuan_admin->move(public_path('document'), $filenamePersetujuanAdmin);

            Peminjaman::where('id', $peminjaman->id)->update([
                    'tgl_konfirmasi_admin' => $day,
                    'status_peminjaman_id' => $statusPeminjamanID,
                    'keterangan_peminjaman' => $request->keterangan_peminjaman,
                    'foto_ktp_peminjam' => $filenameKTP,
                    'persetujuan_admin' => $filenamePersetujuanAdmin,
            ]);
        }
        elseif ($statusPeminjamanID === '3')
        {
            $request->validate([
                'persetujuan_jaksa' => 'required|mimes:pdf|max:2048',
            ]);

            $filenamePersetujuanJaksa = 'Jaksa - ' . $request->persetujuan_jaksa->getClientOriginalName();
            $request->persetujuan_jaksa->move(public_path('document'), $filenamePersetujuanJaksa);

            Peminjaman::where('id', $peminjaman->id)
                ->update([
                    'tgl_konfirmasi_jaksa' => $day,
                    'status_peminjaman_id' => $request->status_peminjaman_id,
                    'keterangan_peminjaman' => $request->keterangan_peminjaman,
                    'persetujuan_jaksa' => $filenamePersetujuanJaksa,
            ]);
        }
        elseif ($statusPeminjamanID === '4')
        {
            Peminjaman::where('id', $peminjaman->id)
                ->update([
                    'tgl_konfirmasi_admin' => $day,
                    'status_peminjaman_id' => $statusPeminjamanID,
                    'keterangan_peminjaman' => $request->keterangan_peminjaman,
            ]);
        }
        elseif ($statusPeminjamanID === '5')
        {
            Peminjaman::where('id', $peminjaman->id)
                ->update([
                    'tgl_konfirmasi_jaksa' => $day,
                    'status_peminjaman_id' => $statusPeminjamanID,
                    'keterangan_peminjaman' => $request->keterangan_peminjaman,
            ]);
        }
        elseif ($statusPeminjamanID === '6')
        {
            Peminjaman::where('id', $peminjaman->id)
                ->update([
                    'status_peminjaman_id' => $statusPeminjamanID,
                    'keterangan_peminjaman' => $request->keterangan_peminjaman,
            ]);
        }
        

        $peminjamanBaru = Peminjaman::find($peminjaman->id);
        $jaksaID = $peminjaman->terdakwa->jaksa->user_id;
        $jaksa = User::where('id',$jaksaID)->first();
        $emailSuperAdmin = User::where('role_id',2)->get('email');
        $emailJaksa = $jaksa->email;
        
        if ($peminjaman->masyarakat_id != NULL){
            $emailMasyarakat = $peminjaman->masyarakat->email;
            Mail::to($emailMasyarakat)->send(new KonfirmasiPeminjamanMail($peminjamanBaru));
            Mail::to($emailJaksa)->cc($emailSuperAdmin)->send(new AdminKonfirmasiPeminjamanMail($peminjamanBaru));
        }else{
            Mail::to($emailJaksa)->cc($emailSuperAdmin)->send(new AdminKonfirmasiPeminjamanMail($peminjamanBaru));
        }

        Alert::info('','Data Peminjaman Berhasil Diproses');
        return redirect('/e-bonpinjam/admin/peminjaman');
    }

    public function destroy($id)
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjaman = Peminjaman::where('id',$peminjamanID)->first();

        if($peminjaman->foto_ktp_peminjam != NULL){
            $fotoKTP = public_path("/document/{$peminjaman->foto_ktp_peminjam}");
            if (File::exists($fotoKTP)) {
                unlink($fotoKTP);
            };
        };

        if($peminjaman->persetujuan_admin != NULL){
            $persetujuanAdmin = public_path("/document/{$peminjaman->persetujuan_admin}");
            if (File::exists($persetujuanAdmin)) {
                unlink($persetujuanAdmin);
            };
        };
        
        if($peminjaman->persetujuan_jaksa != NULL){
            $persetujuanJaksa = public_path("/document/{$peminjaman->persetujuan_jaksa}");
            if (File::exists($persetujuanJaksa)) {
                unlink($persetujuanJaksa);
            };
        };

        Peminjaman::destroy($peminjamanID);

        Alert::success('','Data berhasil di hapus');
        return redirect('/e-bonpinjam/admin/peminjaman');
    }

    public function laporan($id) 
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjamans = Peminjaman::find($peminjamanID);

        $hari = Carbon::parse($peminjamans->tgl_konfirmasi)->translatedFormat('l');
        $tanggal = Carbon::parse($peminjamans->tgl_konfirmasi)->translatedFormat('d F Y');
        $pdf = PDF::loadView('admin.pages.peminjaman.peminjamanpdf', compact('peminjamans','hari','tanggal'));
        $pdf->setPaper('A4');
        return $pdf->stream("peminjaman - ".$peminjamans->kode_peminjaman.".pdf");
    }

    public function unduhktp($id)
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjamans = Peminjaman::find($peminjamanID);

        $ktp = $peminjamans->masyarakat->foto_ktp;
        $pathToFile = public_path('/img/foto_ktp/' . $ktp);
        return response()->download($pathToFile);
    }

    public function persetujuanadmin($id)
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjamans = Peminjaman::find($peminjamanID);

        $persetujuanAdmin = $peminjamans->persetujuan_admin;
        $pathToFile = public_path('/document/' . $persetujuanAdmin);
        return response()->download($pathToFile);
    }

    public function persetujuanjaksa($id)
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjamans = Peminjaman::find($peminjamanID);

        $persetujuanJaksa = $peminjamans->persetujuan_jaksa;
        $pathToFile = public_path('/document/' . $persetujuanJaksa);
        return response()->download($pathToFile);
    }

    public function blanko() 
    {
        $pdf = PDF::loadView('admin.pages.peminjaman.blanko');
        $pdf->setPaper('A4');
        return $pdf->stream("blanko peminjaman.pdf");
    }

}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Barangbukti;
use App\BatasPinjam;
use App\Jaksa;
use App\Kategori;
use App\Masyarakat;
use App\Peminjaman;
use App\PinjamBarbuk;
use App\Terdakwa;
use App\User;
use App\Mail\PeminjamanMail;
use App\Mail\AdminPeminjamanMail;
use Carbon\Carbon;
use Alert;
use Auth;
use Mail;
use PDF;

class MasyarakatController extends Controller
{
    public function index()
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;
        
        $listPeminjaman = Peminjaman::where('masyarakat_id',$user_id)->get();
        $peminjamans = collect($listPeminjaman)->sortBy('id')->reverse()->values();

        $peminjaman = Peminjaman::where('masyarakat_id',$user_id)->get()->count();
        return view('user.index',compact('peminjamans','peminjaman','user'));
    }

    public function peminjaman()
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;
        if ($user->foto_ktp != NULL) {

            // $productCode = Peminjaman::select('kode_peminjaman')->orderBy('id', 'DESC')->take(1)->get();
            // $productCode = Peminjaman::get();

            // Membuat kode otomatis
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
            return view('user.pages.peminjaman.create', compact('user','kodePeminjaman'));
        }
        else {
            Alert::error('Akses Ditolak','Lengkapi Profil Terlebih Dahulu');
            return redirect('/e-bonpinjam/user');
        }
    }

    public function ambildata(Request $request){
        $cek = Terdakwa::where('nama_terdakwa',$request->nama_terdakwa)->where('keluarga_id',$request->keluarga_id)->where('orangtua_terdakwa',$request->orangtua_terdakwa)->where('tkp_desa',$request->tkp_desa)->where('tkp_kecamatan',$request->tkp_kecamatan)->count();
        
        if($cek === 1){
            $ambildata = Terdakwa::where('nama_terdakwa',$request->nama_terdakwa)->where('keluarga_id',$request->keluarga_id)->where('orangtua_terdakwa',$request->orangtua_terdakwa)->where('tkp_desa',$request->tkp_desa)->where('tkp_kecamatan',$request->tkp_kecamatan)->first();
            $bb = Barangbukti::where('terdakwa_id',$ambildata->id)->where('status_id',1)->get();
            return view('user.pages.peminjaman.ambildata', compact('ambildata','bb'));
        }
        else{
            return response()->json([
                'success' => false,
            ]);
        };
    }

    public function storepeminjaman(Request $request)
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
            $tgl_akhir = Carbon::parse($request->tgl_peminjaman)->addDays($value);
            $tgl_peminjaman = Carbon::now()->format('Y-m-d');
            $userId = Auth::user()->id;
            $masyarakat = Masyarakat::where('id',$userId)->first();

            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => $request->kode_peminjaman,
                'nama_peminjam' => $request->nama_peminjam,
                'nik_peminjam' => $request->nik_peminjam,
                'masyarakat_id' => $masyarakat->id,
                'tgl_peminjaman' => $tgl_peminjaman,
                'alamat_peminjam' => $request->alamat_peminjam,
                'terdakwa_id' => $request->terdakwa_id,
                'barang_bukti_id' => $request->barang_bukti_id,
                'tgl_akhir' => $tgl_akhir,
            ]);
            foreach($request->barang_bukti_id as $barbuk)
            {
                $barbuk = PinjamBarbuk::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_bukti_id' => $barbuk
                ]);
            }

            $emailSuperAdmin = User::where('role_id',2)->get('email');
            $emailAdmin = User::where('role_id',1)->get('email');
            $emailMasyarakat = $masyarakat->email;
            Mail::to($emailMasyarakat)->send(new PeminjamanMail($peminjaman));
            Mail::to($emailAdmin)->cc($emailSuperAdmin)->send(new AdminPeminjamanMail($peminjaman));

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

    public function detailpeminjaman($id)
    {
        $user = auth()->guard('masyarakat')->user();
        $user_id = auth()->guard('masyarakat')->user()->id;

        $peminjamanID = Crypt::decrypt($id);
        $peminjaman = Peminjaman::find($peminjamanID);
        // $user = auth()->guard('masyarakat')->user();
        return view('user.pages.peminjaman.detail',compact('peminjaman', 'user'));
    }

    public function pdf($id) 
    {
        $peminjamanID = Crypt::decrypt($id);
        $peminjamans = Peminjaman::find($peminjamanID);

        $hari = Carbon::parse($peminjamans->tgl_konfirmasi)->translatedFormat('l');
        $tanggal = Carbon::parse($peminjamans->tgl_konfirmasi)->translatedFormat('d F Y');
        $pdf = PDF::loadView('user.pages.peminjaman.peminjamanpdf', compact('peminjamans','hari','tanggal'));
        $pdf->setPaper('A4');
        return $pdf->stream("peminjaman - ".$peminjamans->kode_peminjaman.".pdf");
    }

    public function lacak()
    {

        return view('user.pages.lacak.index');
    }

    public function postlacak(Request $request)
    {
        $rules = [
            'kode_peminjaman' => 'required',
        ];
        
        $this->validate($request, $rules);

        $peminjaman = Peminjaman::where('kode_peminjaman', $request->kode_peminjaman)->first();
        if($peminjaman == TRUE){
            return view ('user.pages.lacak.postlacak', compact('peminjaman'));
        }
        Alert::error('Terjadi Kesalahan','Kode Peminjaman Tidak Ada atau Salah');
        return back();
    }
}

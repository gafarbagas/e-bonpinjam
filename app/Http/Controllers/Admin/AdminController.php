<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jaksa;
use App\Terdakwa;
use App\User;
use App\Peminjaman;
use App\Barangbukti;
use Carbon\Carbon;
use Auth;


class AdminController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = Auth::user()->role_id ;
        $jaksa = Jaksa::where('user_id',$userId)->first();
        if($jaksa)
        {
            $idJaksa = $jaksa->id;
            $terdakwa = Terdakwa::where('jaksa_id', $idJaksa)->count();

            if($terdakwa > 0)
            {
            $terdakwa = Terdakwa::where('jaksa_id', $idJaksa)->get();

                foreach($terdakwa as $index => $terdakwas){
                    $idterdakwa[$index] = $terdakwas['id'];
                    $peminjamans[$index] = Peminjaman::where('status_peminjaman_id',2)
                                                        ->where('terdakwa_id', $idterdakwa[$index])->get();
                    $disetujuiJaksas[$index] = Peminjaman::where('status_peminjaman_id',3)
                                                        ->where('terdakwa_id', $idterdakwa[$index])->get();
                    $ditolakJaksas[$index] = Peminjaman::where('status_peminjaman_id',5)
                                                        ->where('terdakwa_id', $idterdakwa[$index])->get();
                }

                foreach($peminjamans as $i){
                    foreach($i as $value){
                        $peminjaman[] = $value;
                    }
                }

                foreach($disetujuiJaksas as $i){
                    foreach($i as $value){
                        $disetujuiJaksa[] = $value;
                    }
                }

                foreach($ditolakJaksas as $i){
                    foreach($i as $value){
                        $ditolakJaksa[] = $value;
                    }
                }

                if( empty($peminjaman) )
                {
                    if( empty($disetujuiJaksa) )
                    {
                        if( empty($ditolakJaksa) )
                        {
                            $peminjaman = [];
                            $disetujuiJaksa = [];
                            $ditolakJaksa = [];
                            $countDitolakJaksa = count($ditolakJaksa);
                            $countDisetujuiJaksa = count($disetujuiJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                        else
                        {
                            $peminjaman = [];
                            $disetujuiJaksa = [];
                            $countDitolakJaksa = count($ditolakJaksa);
                            $countDisetujuiJaksa = count($disetujuiJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                    }
                    else
                    {
                        if( empty($ditolakJaksa) )
                        {
                            $peminjaman = [];
                            $ditolakJaksa = [];
                            $countDitolakJaksa = count($ditolakJaksa);
                            $countDisetujuiJaksa = count($disetujuiJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                        else
                        {
                            $peminjaman = [];
                            $countDitolakJaksa = count($ditolakJaksa);
                            $countDisetujuiJaksa = count($disetujuiJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                    }
                }
                else{
                    if( empty($disetujuiJaksa) )
                    {
                        if( empty($ditolakJaksa) )
                        {
                            $disetujuiJaksa = [];
                            $ditolakJaksa = [];
                            $countDisetujuiJaksa= count($disetujuiJaksa);
                            $countDitolakJaksa= count($ditolakJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','peminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                        else
                        {
                            $disetujuiJaksa = [];
                            $countDisetujuiJaksa= count($disetujuiJaksa);
                            $countDitolakJaksa= count($ditolakJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','peminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                    }
                    else
                    {
                        if( empty($ditolakJaksa) )
                        {
                            $ditolakJaksa = [];
                            $countDisetujuiJaksa= count($disetujuiJaksa);
                            $countDitolakJaksa= count($ditolakJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','peminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                        else
                        {
                            $countDisetujuiJaksa= count($disetujuiJaksa);
                            $countDitolakJaksa= count($ditolakJaksa);
                            $countPeminjaman = count($peminjaman);
                            return view('admin.pages.home',compact('countPeminjaman','peminjaman','countDisetujuiJaksa','countDitolakJaksa'));
                        }
                    }
                }
            }
            else
            {
                $peminjaman = [];
                $disetujuiJaksa = [];
                $diTolakJaksa = [];
                $countPeminjaman = count($peminjaman);
                $countDisetujuiJaksa= count($disetujuiJaksa);
                $countDitolakJaksa= count($diTolakJaksa);
                return view('admin.pages.home',compact('countPeminjaman','countDisetujuiJaksa','countDitolakJaksa'));
            }
        }
        elseif($userRole == 2)
        {
            $peminjaman = Peminjaman::count();
            $belumproses = Peminjaman::where('status_peminjaman_id',1)->count();
            $disetujuiAdmin = Peminjaman::where('status_peminjaman_id',2)->count();
            $disetujuiJaksa = Peminjaman::where('status_peminjaman_id',3)->count();
            $ditolakAdmin = Peminjaman::where('status_peminjaman_id',4)->count();
            $ditolakJaksa = Peminjaman::where('status_peminjaman_id',5)->count();
            $selesai = Peminjaman::where('status_peminjaman_id',6)->count();
            $countNotif = Peminjaman::whereIn('status_peminjaman_id',[1,2])->count();
            $datanotif = Peminjaman::whereIn('status_peminjaman_id',[1,2])->get();
            return view('admin.pages.home',compact('peminjaman','belumproses','disetujuiAdmin','disetujuiJaksa','ditolakAdmin','ditolakJaksa','selesai','datanotif','countNotif'));
        }
        else
        {
            $peminjaman = Peminjaman::count();
            $belumproses = Peminjaman::where('status_peminjaman_id',1)->count();
            $disetujuiAdmin = Peminjaman::where('status_peminjaman_id',2)->count();
            $disetujuiJaksa = Peminjaman::where('status_peminjaman_id',3)->count();
            $ditolakAdmin = Peminjaman::where('status_peminjaman_id',4)->count();
            $ditolakJaksa = Peminjaman::where('status_peminjaman_id',5)->count();
            $selesai = Peminjaman::where('status_peminjaman_id',6)->count();
            $countNotif = Peminjaman::where('status_peminjaman_id',1)->count();
            $datanotif = Peminjaman::where('status_peminjaman_id',1)->get();
            return view('admin.pages.home',compact('peminjaman','belumproses','disetujuiAdmin','disetujuiJaksa','ditolakAdmin','ditolakJaksa','selesai','datanotif','countNotif'));
        }
    }
}

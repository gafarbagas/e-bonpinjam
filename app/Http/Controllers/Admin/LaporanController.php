<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peminjaman;
use App\StatusPeminjaman;
use App\Terdakwa;
use Carbon\Carbon;
use Alert;
use PDF;

class LaporanController extends Controller
{
    public function peminjaman()
    {
        return view('admin.pages.laporan.index');
    }

    public function ambildataPeminjaman(Request $request){

        $status = $request->status_peminjaman_id;

        if ($status == 'semua') {
            $cek = Peminjaman::whereBetween('tgl_peminjaman',[$request->tgl_awal, $request->tgl_akhir])->count();

            if($cek != 0){
                $tgl_awal = $request->tgl_awal;
                $tgl_akhir = $request->tgl_akhir;
                $peminjaman = Peminjaman::whereBetween('tgl_peminjaman',[$request->tgl_awal, $request->tgl_akhir])->get();
                return view ('admin.pages.laporan.ambildata', compact('peminjaman','tgl_awal','tgl_akhir','status'));
            }
            else{
                return response()->json([
                    'success' => false,
                ]);
            };
        }else{
            $cek = Peminjaman::where('status_peminjaman_id', $status)->whereBetween('tgl_peminjaman',[$request->tgl_awal, $request->tgl_akhir])->count();

            if($cek != 0){
                $tgl_awal = $request->tgl_awal;
                $tgl_akhir = $request->tgl_akhir;
                $peminjaman = Peminjaman::where('status_peminjaman_id', $status)->whereBetween('tgl_peminjaman',[$request->tgl_awal, $request->tgl_akhir])->get();
                return view ('admin.pages.laporan.ambildata', compact('peminjaman','tgl_awal','tgl_akhir','status'));
            }
            else{
                return response()->json([
                    'success' => false,
                ]);
            };
        }
    }

    public function laporanPeminjaman(Request $request, $status, $tgl_awal, $tgl_akhir)
    {
        $tgl_awal = Carbon::parse($tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::parse($tgl_akhir)->format('Y-m-d');
        if ($status == 'semua') {
            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman',[$tgl_awal, $tgl_akhir])->get();
            $status = 'Seluruh Status';
            $pdf = PDF::loadView('admin.pages.laporan.pdf', compact('peminjaman', 'tgl_awal','tgl_akhir','status'));
            $pdf->setPaper('A4');
            return $pdf->stream();
            
        }else{
            $peminjaman = Peminjaman::where('status_peminjaman_id', $status)->whereBetween('tgl_peminjaman',[$tgl_awal, $tgl_akhir])->get();
            $statusPeminjaman = StatusPeminjaman::where('id',$status)->first();
            $status = $statusPeminjaman->nama_status_peminjaman;
            $pdf = PDF::loadView('admin.pages.laporan.pdf', compact('peminjaman', 'tgl_awal','tgl_akhir','status'));
            $pdf->setPaper('A4');
            return $pdf->stream();
            // $tgl_awal = Carbon::parse($tgl_awal)->format('Y-m-d');
            // $tgl_akhir = Carbon::parse($tgl_akhir)->format('Y-m-d');
            
        }
    }

    public function laporanSemuaPeminjaman(Request $request){
        $status = $request->status_peminjaman_id;
        $tgl_awal = 0;
        if ($status == 'semua') {
            $peminjaman = Peminjaman::all();
            $status = 'Semua Data';
            $pdf = PDF::loadView('admin.pages.laporan.pdf', compact('peminjaman', 'tgl_awal','status'));
            $pdf->setPaper('A4');
            return $pdf->stream();
        }else{
            $peminjaman = Peminjaman::where('status_peminjaman_id', $status)->get();
            $statusPeminjaman = StatusPeminjaman::where('id',$status)->first();
            $status = 'Semua Data: '.$statusPeminjaman->nama_status_peminjaman;
            $pdf = PDF::loadView('admin.pages.laporan.pdf', compact('peminjaman', 'tgl_awal','status'));
            $pdf->setPaper('A4');
            return $pdf->stream();
        }
    }
}

@extends('admin.layouts.admin')

@if (auth()->user()->role_id == 1)
    @section('title','Admin | E-BONPINJAM')
@elseif (auth()->user()->role_id == 2)
    @section('title','Super Admin | E-BONPINJAM')
@else
    @section('title','Jaksa | E-BONPINJAM')
@endif
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 mt-4 text-black">Beranda</h1>
    </div>
    <!-- Content Row -->
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-xl col-lg">
                        <div class="cardnotif shadow mb-4">
                            <!-- Card Body -->
                            <div class="card-body overflow-auto">
                                @if (auth()->user()->role_id == 3)
                                    @if ($countPeminjaman === 0)
                                        Tidak Ada Pengajuan Peminjaman Barang Bukti
                                    @else
                                        @foreach ($peminjaman as $pinjam)
                                        <?php 
                                            $akhir = $pinjam->tgl_akhir;
                                            $now = Carbon\Carbon::now();
                                            $datetime1 = new DateTime($now);
                                            $datetime2 = new DateTime($akhir);
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format('%a');
                                        ?>
                                            @if ($akhir>$now)
                                            <a href="admin/peminjaman/{{\Crypt::encrypt($pinjam->id)}}/konfirmasi">
                                                <marquee bgcolor='#FFF3CD' behavior='scroll'>
                                                    <font color = 'black'>
                                                        Pengajuan atas nama {{$pinjam->nama_peminjam}} berakhir hari {{Carbon\Carbon::parse($pinjam->tgl_akhir)->TranslatedFormat('l, d F Y')}}.
                                                    <font>
                                                </marquee>
                                            </a>
                                            @elseif ($akhir=$now)
                                            <a href="admin/peminjaman/{{\Crypt::encrypt($pinjam->id)}}/konfirmasi">
                                                <marquee bgcolor='red' behavior='scroll'>
                                                    <font color = 'white'>
                                                        Pengajuan atas nama {{$pinjam->nama_peminjam}} berakhir hari {{Carbon\Carbon::parse($pinjam->tgl_akhir)->TranslatedFormat('l, d F Y')}}.
                                                    <font>
                                                </marquee>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @else
                                    @if ($countNotif === 0)
                                        Tidak Ada Pengajuan Peminjaman Barang Bukti
                                    @else
                                        @foreach ($datanotif as $pinjam)
                                        <?php 
                                            $akhir = $pinjam->tgl_akhir;
                                            $now = Carbon\Carbon::now();
                                            $datetime1 = new DateTime($now);
                                            $datetime2 = new DateTime($akhir);
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format('%a');
                                        ?>
                                            @if ($akhir>$now)
                                            <a href="admin/peminjaman/{{\Crypt::encrypt($pinjam->id)}}/konfirmasi">
                                                <marquee bgcolor='#FFF3CD' behavior='scroll'>
                                                    <font color = 'black'>
                                                        Pengajuan atas nama {{$pinjam->nama_peminjam}} berakhir hari {{Carbon\Carbon::parse($pinjam->tgl_akhir)->TranslatedFormat('l, d F Y')}}.
                                                    <font>
                                                </marquee>
                                            </a>
                                            @elseif ($akhir=$now)
                                            <a href="admin/peminjaman/{{\Crypt::encrypt($pinjam->id)}}/konfirmasi">
                                                <marquee bgcolor='red' behavior='scroll'>
                                                    <font color = 'white'>
                                                        Pengajuan atas nama {{$pinjam->nama_peminjam}} berakhir hari {{Carbon\Carbon::parse($pinjam->tgl_akhir)->TranslatedFormat('l, d F Y')}}.
                                                    <font>
                                                </marquee>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->user()->role_id == 3)
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-red shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pengajuan Peminjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countPeminjaman}}</div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <i class="fas fa-envelope fa-2x text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-red shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Disetujui</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countDisetujuiJaksa}}</div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <i class="fas fa-envelope fa-2x text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-red shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Ditolak</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countDitolakJaksa}}</div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <i class="fas fa-envelope fa-2x text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
                @else
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Peminjaman Barang Bukti</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$peminjaman}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-envelope fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-sm-flex align-items-center">
                                <h1 class="h6 text-black">Status Peminjaman Barang Bukti</h1>
                            </div>

                            <div class="row">    
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Belum  diproses</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$belumproses}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-spinner fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Disetujui Admin</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$disetujuiAdmin}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-check fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Disetujui Jaksa</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$disetujuiJaksa}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-check fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Ditolak Admin</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ditolakAdmin}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-times fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Ditolak Jaksa</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ditolakJaksa}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-times fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-red shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Peminjaman Selesai</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$selesai}}</div>
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <i class="fas fa-check fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
@endsection


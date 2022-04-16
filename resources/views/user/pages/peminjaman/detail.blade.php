@extends('user.layouts.master')

@section('title',' Detail Data Peminjaman')
    
@section ('content')
<!-- Begin Page Content -->
<div class="bg-grey">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-md my-5 mx-auto text-black">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <h1 class="h3 mb-5">Detail Peminjaman</h1>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Kode Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->kode_peminjaman}}</b>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Status Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                @if ($peminjaman->status_peminjaman_id === 1)
                                    <span class="badge badge-pill badge-secondary">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                @elseif ($peminjaman->status_peminjaman_id === 2)
                                    <span class="badge badge-pill badge-info">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                @elseif ($peminjaman->status_peminjaman_id === 3)
                                    <span class="badge badge-pill badge-success">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                @else
                                    <span class="badge badge-pill badge-danger">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Keterangan Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->keterangan_peminjaman ?? '-'}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Nama Peminjam</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->nama_peminjam}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">NIK</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->nik_peminjam}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Tanggal Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{\Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('d F Y')}}</b>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Alamat Peminjam</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->alamat_peminjam}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Nama Terdakwa</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->terdakwa->nama_terdakwa}} {{$peminjaman->terdakwa->keluarga->keluarga}} {{$peminjaman->terdakwa->orangtua_terdakwa}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Nama Jaksa</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->terdakwa->jaksa->nama_jaksa}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">TKP</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->terdakwa->tkp_desa}}, {{$peminjaman->terdakwa->tkp_kecamatan}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Barang Bukti</label>
                            <div class="col-xl-8 col-md-9">
                                <div class="row">
                                    <div class="col">
                                        @foreach ($peminjaman->pinjambarbuk as $barangbukti)
                                            {{$loop->iteration}}. <b>{{ $barangbukti->bb->nama_barangbukti }}</b><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
@endsection
@extends('user.layouts.master')

@section('title','E-BonPinjam | Profil')
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-md my-5 text-black mx-auto justify-content-center">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-sm text-sm-left">
                                <h1 class="h3">Profil Anda</h1>
                            </div>
                            <div class="col-sm text-sm-right">
                                <a href="/e-bonpinjam/user/ubahprofil/{{\Crypt::encrypt($user->id)}}" class="btn btn-brown btn-icon-split btn-sm">
                                    <span class="icon text-white">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Ubah Profil</span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <img src="/img/profile/{{ $user->avatar }}" style="width:150px; height:150px; border-radius:50%;">
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-4">
                                Nama
                            </div>
                            <div class="col-md-8">
                                {{ $user->nama_masyarakat }}
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                NIK
                            </div>
                            <div class="col-md-8">
                                {{ $user->nik_masyarakat }}
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                Alamat
                            </div>
                            <div class="col-md-8">
                                {{ $user->alamat }}
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                E-mail
                            </div>
                            <div class="col-md-8">
                                {{ $user->email }}
                            </div>
                        </div>

                        @if ($user->foto_ktp != NULL)
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    Foto KTP
                                </div>
                                <div class="col-md-8">
                                    <img src="/img/foto_ktp/{{ $user->foto_ktp }}">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
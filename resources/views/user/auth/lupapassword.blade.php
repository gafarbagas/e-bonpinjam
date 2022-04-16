@extends('user.layouts.login')

@section('title','E-BonPinjam | Lupa Password')

@section('content')

<div class="content">
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-10 col-md-9">

            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <img src="{{url('img/logokejaksaan.png')}}" style="width: 70px">
                            </div>
                            <h1 class="h4 text-black">E-BonPinjam</h1>
                            <h1 class="h6 text-black">Kejaksaan Negeri Purwokerto</h1>
                        </div>
                        <div class="text-center">
                            <h1 class="h6">Masukan email anda dan kami akan kirimkan form untuk mendapatkan akun anda kembali</h1>
                        </div>
                        <form class="user" action="/e-bonpinjam/lupapassword" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Masukan E-mail" value="{{old('email')}}">
                            </div>
                            <div class="row text-center">
                                <div class="col-lg-6 text-lg-left col-sm-6 text-black mb-2">
                                    <a href="{{('/e-bonpinjam')}}" class="btn btn-secondary">
                                        <i class="fa fa-angle-left"></i> Login
                                    </a>
                                </div>
                                <div class="col-lg-6 text-lg-right col-sm-6 text-black mb-2">
                                    <button type="submit" class="btn btn-brown">
                                        Kirim E-Mail
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
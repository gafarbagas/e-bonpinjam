@extends('admin.layouts.login')

@section('title','Login Admin E-Bonpinjam')

@section('content')

<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-10 col-md-9">

        <div class="card shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                {{-- <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6"> --}}
                        <div class="p-4">
                            <div class="text-center">
                                <div class="mb-3">
                                    <img src="{{url('img/logokejaksaan.png')}}" style="width: 70px">
                                </div>
                                <h1 class="h4 text-black">Admin E-BonPinjam</h1>
                                <h6 class="text-black mb-4">Kejaksaan Negeri Purwokerto</h6>
                            </div>

                            @if (Session::has('pesan'))
                                <div class="alert alert-danger" role="alert">
                                    {!! Session::get('pesan') !!}
                                </div>
                            @endif

                            <form class="user" action="/e-bonpinjam/postlogin" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukan Alamat E-mail">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan E-Mail
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Masukan Password">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan Password
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-brown btn-user btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    {{-- </div>
                </div> --}}
            </div>
        </div>

    </div>

</div>

@endsection
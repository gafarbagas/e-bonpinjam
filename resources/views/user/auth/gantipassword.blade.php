@extends('user.layouts.login')

@section('title','Login E-BonPinjam')

@section('content')

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
                    <form method="POST" action="/e-bonpinjam/lupapassword/{{$token}}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-brown">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
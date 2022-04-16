@extends('user.layouts.login')

@section('title','Login E-BonPinjam')

@section('content')
<div class="content">
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-10 col-md-9">

            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="text-center">
                            <div class="mb-3">
                                <img src="{{url('img/logokejaksaan.png')}}" style="width: 70px">
                            </div>
                            <h1 class="h4 text-black">E-BonPinjam</h1>
                            <h6 class="text-black">Kejaksaan Negeri Purwokerto</h6>
                            
                            <div class="card mb-3">
                                <div class="card-body text-left text-dark p-2">
                                    Selamat datang
                                    di halaman layanan online E-Bonpinjam, Kejaksaan Negeri Purwokerto. <br><br>
                                    Jika Anda sudah memiliki akun, dapat Login pada kolom di bawah ini.<br><br>
                                    Untuk pengguna baru yang belum memiliki akun, silakan klik tombol Daftar Sekarang dan harap melengkapi biodata diri Anda. <br>
                                    Terima kasih.
                                </div>
                            </div>
                        </div>

                        @if (Session::has('pesan'))
                            <div class="alert alert-danger" role="alert">
                                {!! Session::get('pesan') !!}
                            </div>
                        @endif

                        <form class="user" action="/e-bonpinjam/loginproses" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-mail" placeholder="Masukan Alamat E-mail" value="{{old('email')}}">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan E-Mail
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukan Password">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan Password
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <input type="checkbox" id="lihatpassword" onclick="myFunction()">
                                    <label class="form-check-label text-black" for="lihatpassword">
                                        Lihat Password
                                    </label>
                                </div>
                            </div>

                            

                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-brown">
                                    Login
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="row text-center">
                            <div class="col-lg-6 text-lg-left col-sm-6 text-black">
                                <a class="small" href="{{('/e-bonpinjam/lupapassword')}}">Lupa Password?</a>
                            </div>

                            <div class="col-lg-6 text-lg-right text-black">
                                <a class="small">Belum memiliki akun?</a><br>
                                <a class="small" href="{{('/e-bonpinjam/registrasi')}}">Daftar sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@section('script')
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
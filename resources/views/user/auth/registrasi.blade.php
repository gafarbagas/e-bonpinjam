@extends('user.layouts.login')

@section('title','E-BonPinjam | Register Akun')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <img src="{{url('img/logokejaksaan.png')}}" style="width: 70px">
                                    </div>
                                    <h1 class="h4 text-black">E-BonPinjam</h1>
                                    <h6 class="text-black mb-4">Registrasi Akun</h6>
                                </div>
                                <form class="user" action="/e-bonpinjam/registrasi" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6 class="text-black">Data Diri</h6>
                                    <div class="form-group">
                                        <input type="text" id="nama_masyarakat" name="nama_masyarakat" class="form-control @error('nama_masyarakat') is-invalid @enderror" autofocus placeholder="Masukan Nama" value="{{ old('nama_masyarakat') }}">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Nama
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="no_ktp" name="nik_masyarakat" class="form-control @error('nik_masyarakat') is-invalid @enderror" placeholder="Masukan NIK" value="{{ old('nik_masyarakat') }}">
                                        @error('nik_masyarakat')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukan Alamat" value="{{ old('alamat') }}"></textarea>
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Alamat
                                        </div>
                                    </div>

                                    <h6 class="text-black mt-4">Akun</h6>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-mail" placeholder="Masukan Alamat E-mail" value="{{old('email')}}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <small>Gunakan Google E-mail</small>
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
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-brown">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
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
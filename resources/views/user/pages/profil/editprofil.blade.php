@extends('user.layouts.master')

@section('title','E-BonPinjam | Ubah Profil')
    
@section ('content')
<!-- Begin Page Content -->
<div class="container">

        <div class="row">
            <div class="col-xl-8 col-md my-5 text-black mx-auto justify-content-center">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col text-sm-left">
                                    <h1 class="h3">Ubah Profil</h1>
                                </div>
                            </div>
                            <form action="/e-bonpinjam/user/ubahprofil/{{$user->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <img src="/img/profile/{{ $user->avatar }}" style="width:150px; height:150px;">
                                    </div>
                                    <div class="col-md-6 my-auto">
                                        <label class="form-label">Ubah Foto Profil</label><br>
                                        <input type="file" accept="image/*" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar"/>
                                        <div class="invalid-feedback">
                                            File harus berupa gambar atau foto
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nik_masyarakat" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="mb-1 form-control" readonly value="{{ $user->nik_masyarakat }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="nama_masyarakat" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="mb-1 form-control @error('nama_masyarakat') is-invalid @enderror" name="nama_masyarakat" id="nama_masyarakat" placeholder="Nama" value="{{ $user->nama_masyarakat }}">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Nama
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="mb-1 form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" value="{{ $user->alamat }}">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Alamat
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">E-Mail</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="mb-1 form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="E-Mail" value="{{ $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                @if ($user->foto_ktp == NULL)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Foto KTP</label>
                                        <div class="col-sm-8">
                                            <input type="file" accept="image/*" class="mb-1 form-control-file @error('foto_ktp') is-invalid @enderror" name="foto_ktp">
                                            @error('foto_ktp')
                                                <div class="invalid-feedback">
                                                    File harus berupa gambar atau foto
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <a href="/e-bonpinjam/user/profil" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
                                    </div>
                                    <div class="col-md-7">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<!-- /.container -->
@endsection
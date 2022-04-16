@extends('admin.layouts.admin')

@section('title','Tambah Data Jaksa')

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Tambah Data Jaksa</h1>
    </div>
    
    <div class="row">
        <div class="col-xl text-black">
            <div class="card">
                <div class="card-body">
                    <form action="/e-bonpinjam/admin/jaksa" method="POST">
                    @csrf
                        
                        <div class="form-group row">
                            <label for="nrp_jaksa" class="col-sm-2 col-form-label">NRP</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('nrp_jaksa') is-invalid @enderror" name="nrp_jaksa" id="nrp_jaksa" placeholder="Masukan NRP" value="{{ old('nrp_jaksa') }}">
                                @error('nrp_jaksa')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nama_jaksa" class="col-sm-2 col-form-label">Nama Jaksa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('nama_jaksa') is-invalid @enderror" name="nama_jaksa" id="nama_jaksa" placeholder="Nama Jaksa" value="{{ old('nama_jaksa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Jaksa
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan" placeholder="Jabatan" value="{{ old('jabatan') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Jabatan
                                </div>
                            </div>
                        </div>  
                        
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat" placeholder="Masukan Pangkat" value="{{ old('pangkat') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Pangkat
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukan email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukan Password" value="{{ old('password') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Password
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <a href="/e-bonpinjam/admin/jaksa" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
                            </div>
                            <div class="col-md-7">
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
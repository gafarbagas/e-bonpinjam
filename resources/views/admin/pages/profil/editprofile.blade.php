@extends('admin.layouts.admin')

@section('title','Ubah Profil Pengguna')
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->

    <div class="row">
        <div class="col-md-8 mt-4 mb-4 text-black">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0">Profil</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/img/profile/{{ $user->avatar }}" style="width:150px; height:150px; border-radius:50%;">
                        </div>

                        <form action="/e-bonpinjam/admin/adminprofil" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mt-4">
                            
                                <input type="text" class="form-control @error('name') is-invalid @enderror mb-3" name="name" id="name" placeholder="Nama Pengguna" value="{{ $user->name }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Pengguna
                                </div>
                            
                            
                                <label>Ubah Foto Profil</label><br>
                                <input type="file" name="avatar">
                                
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" value="{{ $user->email }}">
                            <div class="invalid-feedback">
                                Silahkan Masukan E-mail
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="role" class="col-sm-4 col-form-label">Hak Akses</label>
                        <div class="col-3">
                            <input type="text" class="form-control" id="role" value="{{ $user->role->role_name }}" disabled>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-2 mt-4">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Ubah</button>
                            </div>
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
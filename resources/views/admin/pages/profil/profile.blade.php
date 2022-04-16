@extends('admin.layouts.admin')

@section('title','Profil Pengguna')
    
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
                        <div class="col-md-8 mt-5">
                            <h2>{{ $user->name }}</h2>
                        </div>
                        <div class="col-md-1">
                            <a href="/e-bonpinjam/admin/adminprofil/edit" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            E-Mail
                        </div>
                        <div class="col-md-8">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            Hak Akses
                        </div>
                        <div class="col-md-8">
                            {{ $user->role->role_name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
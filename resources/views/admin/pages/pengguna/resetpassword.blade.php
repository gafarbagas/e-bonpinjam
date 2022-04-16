@extends('admin.layouts.admin')

@section('title','Ubah Password Pengguna')
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->

    <div class="row">
        <div class="col-md-8 mt-4 mb-4 text-black">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0">Ubah Kata Sandi {{$user->name}}</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="/e-bonpinjam/admin/pengguna/{{$user->id}}/ubahkatasandi" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="katasandibaru" class="col-sm-3 col-form-label">Kata Sandi Baru</label>
                            <div class="col-sm">
                                <input type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" id="katasandibaru" placeholder="Password">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Kata Sandi Baru
                                </div>
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
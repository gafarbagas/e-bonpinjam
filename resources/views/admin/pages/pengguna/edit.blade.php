@extends('admin.layouts.admin')

@section('title',' Ubah Data Pengguna')
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Ubah Data Pengguna</h1>
    </div>

    <div class="row">
        <div class="col-xl text-black">
            <div class="card">
                <div class="card-body">
                    <form action="/e-bonpinjam/admin/pengguna/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ $user->name }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama
                                </div>
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="role_id" class="col-sm-2 col-form-label">Hak Akses</label>
                            <div class="col-sm-3">
                                <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                                    @foreach (\App\Role::orderBy('role_name','asc')->get() as $role)
                                                <option value="{{ $role->id }}" {{$role->id == $user->role_id ? 'selected' : ''}}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan Masukan Hak Akses
                                </div>
                            </div>
                        </div>
                            
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="E-mail" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    
                        {{-- <div class="form-group row">
                            <label for="avatar" class="col-sm-3 col-form-label">Foto Profil</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar">
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Kata Sandi</label>
                            <div class="col-sm-9">
                                <a href="/e-bonpinjam/admin/pengguna/{{Crypt::encrypt($user->id)}}/ubahkatasandi" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">Ubah Kata Sandi <i class="fa fa-key"></i></a>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-5">
                                <a href="/e-bonpinjam/admin/pengguna" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
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

<!-- /.container-fluid -->
@endsection


@extends('admin.layouts.admin')

@section('title',' Tambah Data Pengguna')
    
@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Tambah Data Pengguna</h1>
    </div>

    <div class="row">
        <div class="col-sm text-black">
            <div class="card">
                <div class="card-body">
                    <form action="/e-bonpinjam/admin/pengguna" method="POST">
                    @csrf
                        
                        <div class="form-group row">
                            <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role"  class="col-sm-2 col-form-label">Hak Akses</label>
                            <div class="col-sm-3">
                                <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" id="role" value="{{ old('role_id') }}">
                                    <option value="">Pilih Hak Akses</option>
                                    @foreach (\App\Role::orderBy('role_name','asc')->get() as $role)
                                        <option value="{{ $role->id }}" @if (old('role_id') == "$role->id") {{ 'selected' }} @endif>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan Masukan Hak Akses
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email"  class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"  class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"value="{{ old('password') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Password
                                </div>
                            </div>
                        </div>
                            
                
                        <div class="row">
                            <div class="col-md-5">
                                <a href="/e-bonpinjam/admin/pengguna" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
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



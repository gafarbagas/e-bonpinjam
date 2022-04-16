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
                    <form action="/e-bonpinjam/admin/jaksa/{{$jaksa->id}}" method="POST">
                    @csrf
                    @method('patch')

                        <div class="form-group row">
                            <label for="nrp_jaksa" class="col-sm-2 col-form-label">NRP</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('nrp_jaksa') is-invalid @enderror" name="nrp_jaksa" id="nrp_jaksa" placeholder="Masukan NRP"value="{{ $jaksa->nrp_jaksa }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan NRP
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nama_jaksa" class="col-sm-2 col-form-label">Nama Jaksa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('nama_jaksa') is-invalid @enderror" name="nama_jaksa" id="nama_jaksa" placeholder="Nama Jaksa" value="{{ $jaksa->nama_jaksa }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Jaksa
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan" placeholder="Masukan Jabatan" value="{{ $jaksa->jabatan }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Jabatan
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat" placeholder="Masukan Pangkat" value="{{ $jaksa->pangkat }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Pangkat
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukan E-Mail" value="{{ $jaksa->user->email }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan E-Mail
                                </div>
                            </div>
                        </div>
                
                        <div class="row justify-content-center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
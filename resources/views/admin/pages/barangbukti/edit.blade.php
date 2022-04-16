@extends('admin.layouts.admin')

@section('title','Ubah Barang Bukti')

@section ('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Ubah Barang Bukti</h1>
    </div>
    
    <div class="row">
        <div class="col-xl text-black">
            <div class="card">
                <div class="card-body">
                    
                    <form action="/e-bonpinjam/admin/barangbukti/{{$barangbukti->id}}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="terdakwa_id" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                            <div class="col-sm-4">
                                <input id="kode_barangbukti" type="text" name="terdakwa_id" class="form-control" value="{{$barangbukti->terdakwa->nama_terdakwa}} {{$barangbukti->terdakwa->keluarga->keluarga}} {{$barangbukti->terdakwa->orangtua_terdakwa}}" readonly/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_barangbukti" class="col-sm-2 col-form-label">Kode Barang Bukti</label>
                            <div class="col-sm-4">
                                <input id="kode_barangbukti" type="text" name="kode_barangbukti" class="form-control" value="{{$barangbukti->kode_barangbukti}}" readonly/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_barangbukti" class="col-sm-2 col-form-label">Nama Barang Bukti</label>
                            <div class="col-sm-10">
                                <input id="kode_barangbukti" type="text" name="nama_barangbukti" class="form-control @error('nama_barangbukti') is-invalid @enderror" value="{{$barangbukti->nama_barangbukti}}"/>
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Barang Bukti
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status_id" class="col-sm-2 col-form-label">Nama Status</label>
                            <div class="col-sm-4">
                                <select type="text" class="form-control @error('status_id') is-invalid @enderror" name="status_id" id="status_id">
                                    @foreach (\App\Status::orderBy('nama_status','asc')->get() as $status)
                                        <option value="{{ $status->id }}" {{$status->id == $barangbukti->status_id ? 'selected' : ''}}>{{ $status->nama_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-md-5">
                                <a href="/e-bonpinjam/admin/barangbukti" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
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
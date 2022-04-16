@extends('admin.layouts.admin')

@section('title','Tambah Barang Bukti')

@section ('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Tambah Barang Bukti</h1>
    </div>
    
    <div class="row">
        <div class="col-xl text-black">
            <div class="card">
                <div class="card-body">
                    
                    <form action="/e-bonpinjam/admin/barangbukti" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="terdakwa_id" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                            <div class="col-sm-4">
                                <select type="text" class="form-control @error('terdakwa_id') is-invalid @enderror" name="terdakwa_id" id="terdakwa_id">
                                    <option>- Pilih -</option>
                                    @foreach (\App\Terdakwa::orderBy('nama_terdakwa','asc')->get() as $terdakwa)
                                    <option value="{{ $terdakwa->id }}" @if (old('terdakwa_id') == "$terdakwa->id") {{ 'selected' }} @endif>{{ ucfirst($terdakwa->nama_terdakwa) }} {{$terdakwa->keluarga->keluarga}} {{ucfirst($terdakwa->orangtua_terdakwa)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_barangbukti" class="col-sm-2 col-form-label">Kode Barang Bukti</label>
                            <div class="col-sm-3">
                                <input id="kode_barangbukti" type="text" name="kode_barangbukti" class="form-control" value="{{$kodeBarangBukti}}" readonly/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_barangbukti" class="col-sm-2 col-form-label">Nama Barang Bukti</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_barangbukti" placeholder="Nama Barang Bukti" class="form-control @error('nama_barangbukti') is-invalid @enderror" id="nama_barangbukti"/>
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Barang Bukti
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Barang Bukti</label>
                            <div class="col-sm-2">
                                <select type="text" class="form-control @error('status_id') is-invalid @enderror" name="status_id">
                                    @foreach (\App\Status::orderBy('id','asc')->get() as $stat)
                                        <option value="{{ $stat->id }}" @if (old('status_id') == "$stat->id") {{ 'selected' }} @endif>{{ $stat->nama_status }}</option>
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
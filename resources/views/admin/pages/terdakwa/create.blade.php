@extends('admin.layouts.admin')

@section('title','Tambah Data Terdakwa')

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Tambah Data Terdakwa</h1>
    </div>
    
    <div class="row">
        <div class="col-xl text-black">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="/e-bonpinjam/admin/terdakwa" method="POST">
                    @csrf
                        
                        <div class="form-group row">
                            <label for="kode_terdakwa" class="col-sm-2 col-form-label">Kode Terdakwa</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="kode_terdakwa" id="kode_terdakwa" value="{{ $kodeTerdakwa }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jaksa_id" class="col-sm-2 col-form-label">Nama Jaksa</label>
                            <div class="col-sm-4">
                                <select type="text" class="form-control @error('jaksa_id') is-invalid @enderror" name="jaksa_id" id="jaksa_id">
                                    <option>- Pilih -</option>
                                    @foreach (\App\Jaksa::orderBy('nama_jaksa','asc')->get() as $jaksa)
                                        <option value="{{ $jaksa->id }}" @if (old('jaksa_id') == "$jaksa->id") {{ 'selected' }} @endif>{{ $jaksa->nama_jaksa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik_terdakwa" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('nik_terdakwa') is-invalid @enderror" name="nik_terdakwa" id="nik_terdakwa" placeholder="Masukan NIK"value="{{ old('nik_terdakwa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan NIK
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nama_terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('nama_terdakwa') is-invalid @enderror" name="nama_terdakwa" id="nama_terdakwa" placeholder="Nama Terdakwa" value="{{ old('nama_terdakwa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Terdakwa
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <select type="text" class="form-control @error('keluarga_id') is-invalid @enderror" name="keluarga_id" id="keluarga_id">
                                    @foreach (\App\Keluarga::orderBy('keluarga','asc')->get() as $kel)
                                        <option value="{{ $kel->id }}" @if (old('keluarga_id') == "$kel->id") {{ 'selected' }} @endif>{{ $kel->keluarga }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('orangtua_terdakwa') is-invalid @enderror" name="orangtua_terdakwa" id="orangtua_terdakwa" placeholder="Nama Orang Tua" value="{{ old('orangtua_terdakwa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Nama Orang Tua
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Tempat Lahir
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Tanggal Lahir
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tkp_desa" class="col-sm-2 col-form-label">TKP Desa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('tkp_desa') is-invalid @enderror" name="tkp_desa" id="tkp_desa" placeholder="Masukan TKP Desa" value="{{ old('tkp_desa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan TKP Desa
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tkp_kecamatan" class="col-sm-2 col-form-label">TKP Kecamatan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('tkp_kecamatan') is-invalid @enderror" name="tkp_kecamatan" id="tkp_kecamatan" placeholder="Masukan TKP Kecamatan" value="{{ old('tkp_kecamatan') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan TKP Kecamatan
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agama_id" class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-2">
                                <select type="text" class="form-control @error('agama_id') is-invalid @enderror" name="agama_id" id="agama_id">
                                    <option>- Pilih -</option>
                                    @foreach (\App\Agama::orderBy('id')->get() as $ag)
                                        <option value="{{ $ag->id }}" @if (old('agama_id') == "$ag->id") {{ 'selected' }} @endif>{{ $ag->nama_agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat_terdakwa" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('alamat_terdakwa') is-invalid @enderror" name="alamat_terdakwa" id="alamat_terdakwa" placeholder="Masukan Alamat" value="{{ old('alamat_terdakwa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Alamat
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pekerjaan_terdakwa" class="col-sm-2 col-form-label">Pekerjaan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('pekerjaan_terdakwa') is-invalid @enderror" name="pekerjaan_terdakwa" id="pekerjaan_terdakwa" placeholder="Masukan Pekerjaan" value="{{ old('pekerjaan_terdakwa') }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Pekerjaan
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kewarganegaraan_id" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-2">
                                <select type="text" class="form-control @error('kewarganegaraan_id') is-invalid @enderror" name="kewarganegaraan_id" id="kewarganegaraan_id">
                                    <option>- Pilih -</option>
                                    @foreach (\App\Kewarganegaraan::orderBy('id')->get() as $kwn)
                                        <option value="{{ $kwn->id }}" @if (old('kewarganegaraan_id') == "$kwn->id") {{ 'selected' }} @endif>{{ $kwn->nama_kewarganegaraan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pendidikan_id" class="col-sm-2 col-form-label">Pendidikan</label>
                            <div class="col-sm-2">
                                <select type="text" class="form-control @error('pendidikan_id') is-invalid @enderror" name="pendidikan_id" id="pendidikan_id">
                                    <option>- Pilih -</option>
                                    @foreach (\App\Pendidikan::orderBy('id')->get() as $pen)
                                        <option value="{{ $pen->id }}" @if (old('pendidikan_id') == "$pen->id") {{ 'selected' }} @endif>{{ $pen->nama_pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <a href="/e-bonpinjam/admin/terdakwa" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
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
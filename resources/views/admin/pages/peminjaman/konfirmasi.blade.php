@extends('admin.layouts.admin')

@section('title','Konfirmasi Peminjaman')

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">
    
    <div class="row mb-3">
        <div class="col-xl-12 text-black">
            <div class="card">
                <div class="card-header">
                    <h5><b>Detail Peminjaman</b></h5> 
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Kode Peminjaman</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->kode_peminjaman}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Nama Peminjam</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->nama_peminjam}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">NIK</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->nik_peminjam}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Tanggal Peminjaman</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{\Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('d F Y')}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Alamat Peminjam</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->alamat_peminjam}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Nama Terdakwa</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->terdakwa->nama_terdakwa}} {{$peminjaman->terdakwa->keluarga->keluarga}} {{$peminjaman->terdakwa->orangtua_terdakwa}}</b>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Nama Jaksa</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->terdakwa->jaksa->nama_jaksa}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">TKP</label>
                        <div class="col-xl-9 col-md-9">
                            <b>{{$peminjaman->terdakwa->tkp_desa}}, {{$peminjaman->terdakwa->tkp_kecamatan}}</b>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">Barang Bukti</label>
                        <div class="col-xl-9 col-md-9">
                            <div class="row">
                                <div class="col">
                                    @foreach ($peminjaman->pinjambarbuk as $barangbukti)
                                        {{$loop->iteration}}. <b>{{ $barangbukti->bb->nama_barangbukti }}</b><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-md-3">KTP Peminjam</label>
                        <div class="col-xl-9 col-md-9">
                            <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/unduhktp" class="btn btn-sm btn-info">Unduh <i class="fa fa-download"></i></a>
                        </div>
                    </div>
                    @if (auth()->user()->role_id == 3)
                        <div class="form-group row">
                            <label class="col-xl-3 col-md-3">Persetujuan Admin</label>
                            <div class="col-xl-9 col-md-9">
                                <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/persetujuanadmin" class="btn btn-sm btn-info">Unduh <i class="fa fa-download"></i></a>
                            </div>
                        </div>
                    @elseif (auth()->user()->role_id == 2)
                        @if ($peminjaman->persetujuan_admin !== NULL)
                            <div class="form-group row">
                                <label class="col-xl-3 col-md-3">Persetujuan Admin</label>
                                <div class="col-xl-9 col-md-9">
                                    <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/persetujuanadmin" class="btn btn-sm btn-info">Unduh <i class="fa fa-download"></i></a>
                                </div>
                            </div>
                            @if ($peminjaman->persetujuan_jaksa !== NULL)
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-3">Persetujuan Jaksa</label>
                                    <div class="col-xl-9 col-md-9">
                                        <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/persetujuanjaksa" class="btn btn-sm btn-info">Unduh <i class="fa fa-download"></i></a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-xl-12 text-black">
            <div class="card">
                <div class="card-header">
                    <h5><b>Konfirmasi Peminjaman</b></h5> 
                </div>
                <div class="card-body">
                    <form method="POST" action="/e-bonpinjam/admin/peminjaman/{{$peminjaman->id}}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        @if ($peminjaman->status_peminjaman_id != 6)
                            @if (auth()->user()->role_id == 1)
                                @if ($peminjaman->status_peminjaman_id == 1)
                                    <div class="form-group row">
                                        <label for="status_peminjaman_id" class="col-sm-3 col-form-label">Status Peminjaman</label>
                                        <div class="col-sm-3">
                                            <select type="text" class="form-control @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                                <option>- Pilih -</option>
                                                @foreach (\App\StatusPeminjaman::orderBy('id','asc')->whereIn('id',[2,4])->get() as $stat)
                                                    <option value="{{ $stat->id }}" {{$stat->id == $peminjaman->status_peminjaman_id ? 'selected' : ''}}>{{ $stat->nama_status_peminjaman }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unggah Foto KTP Peminjam</label>
                                        <div class="col-sm-3">
                                            <input type="file" accept="image/*" class="mb-1 form-control-file @error('foto_ktp_peminjam') is-invalid @enderror" name="foto_ktp_peminjam">
                                            @error('foto_ktp_peminjam')
                                                <div class="invalid-feedback">
                                                    File harus berupa gambar atau foto
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unggah Persetujuan Admin</label>
                                        <div class="col-sm-3">
                                            <input type="file" accept="application/pdf" class="mb-1 form-control-file @error('persetujuan_admin') is-invalid @enderror" name="persetujuan_admin">
                                            @error('persetujuan_admin')
                                                <div class="invalid-feedback">
                                                    File harus berupa PDF
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif($peminjaman->status_peminjaman_id == 3)
                                    <div class="form-group row">
                                        <label for="status_peminjaman_id" class="col-sm-3 col-form-label">Status Peminjaman</label>
                                        <div class="col-sm-3">
                                            <select type="text" class="form-control @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                                <option>- Pilih -</option>
                                                @foreach (\App\StatusPeminjaman::orderBy('id','asc')->whereIn('id',[3,6])->get() as $stat)
                                                    <option value="{{ $stat->id }}" {{$stat->id == $peminjaman->status_peminjaman_id ? 'selected' : ''}}>{{ $stat->nama_status_peminjaman }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-3">Status Peminjaman</label>
                                        <div class="col-xl-9 col-md-9">
                                            <b>{{$peminjaman->statuspeminjaman->nama_status_peminjaman}}</b>
                                        </div>
                                    </div>
                                @endif
                            @elseif (auth()->user()->role_id == 3)
                                @if ($peminjaman->status_peminjaman_id == 2)
                                    <div class="form-group row">
                                        <label for="status_peminjaman_id" class="col-sm-3 col-form-label">Status Peminjaman</label>
                                        <div class="col-sm-3">
                                            <select type="text" class="form-control @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                                <option>- Pilih -</option>
                                                @foreach (\App\StatusPeminjaman::orderBy('id','asc')->whereIn('id',[3,5])->get() as $stat)
                                                    <option value="{{ $stat->id }}" {{$stat->id == $peminjaman->status_peminjaman_id ? 'selected' : ''}}>{{ $stat->nama_status_peminjaman }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unggah Persetujuan Jaksa</label>
                                        <div class="col-sm-3">
                                            <input type="file" accept="application/pdf" class="mb-1 form-control-file @error('persetujuan_jaksa') is-invalid @enderror" name="persetujuan_jaksa">
                                            @error('persetujuan_jaksa')
                                                <div class="invalid-feedback">
                                                    File harus berupa PDF
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-3">Status Peminjaman</label>
                                        <div class="col-xl-9 col-md-9">
                                            <b>{{$peminjaman->statuspeminjaman->nama_status_peminjaman}}</b>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="form-group row">
                                    <label for="status_peminjaman_id" class="col-sm-3 col-form-label">Status Peminjaman</label>
                                    <div class="col-sm-3">
                                        <select type="text" class="form-control @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                                <option>- Pilih -</option>
                                            @foreach (\App\StatusPeminjaman::orderBy('id','asc')->get() as $stat)
                                                <option value="{{ $stat->id }}" {{$stat->id == $peminjaman->status_peminjaman_id ? 'selected' : ''}}>{{ $stat->nama_status_peminjaman }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unggah Foto KTP Peminjam</label>
                                    <div class="col-sm-3">
                                        <input type="file" accept="image/*" class="mb-1 form-control-file @error('foto_ktp_peminjam') is-invalid @enderror" name="foto_ktp_peminjam">
                                        @error('foto_ktp_peminjam')
                                            <div class="invalid-feedback">
                                                File harus berupa gambar atau foto
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unggah Persetujuan Admin</label>
                                    <div class="col-sm-3">
                                        <input type="file" accept="application/pdf" class="mb-1 form-control-file @error('persetujuan_admin') is-invalid @enderror" name="persetujuan_admin">
                                        @error('persetujuan_admin')
                                            <div class="invalid-feedback">
                                                File harus berupa PDF
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unggah Persetujuan Jaksa</label>
                                    <div class="col-sm-3">
                                        <input type="file" accept="application/pdf" class="mb-1 form-control-file @error('persetujuan_jaksa') is-invalid @enderror" name="persetujuan_jaksa">
                                        @error('persetujuan_jaksa')
                                            <div class="invalid-feedback">
                                                File harus berupa PDF
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if (auth()->user()->role_id == 2)
                                <div class="form-group row">
                                    <label for="keterangan_peminjaman" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('keterangan_peminjaman') is-invalid @enderror" name="keterangan_peminjaman" id="keterangan_peminjaman" placeholder="Masukan Keterangan" autocomplete="off" value="{{ old('keterangan_peminjaman') }}">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Keterangan
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <button class="btn btn-success" type="submit">Konfirmasi</button>
                                </div>
                            @elseif(auth()->user()->role_id == 1)
                                @if ($peminjaman->status_peminjaman_id == 1 or $peminjaman->status_peminjaman_id == 3)
                                    <div class="form-group row">
                                        <label for="keterangan_peminjaman" class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('keterangan_peminjaman') is-invalid @enderror" name="keterangan_peminjaman" id="keterangan_peminjaman" placeholder="Masukan Keterangan" autocomplete="off" value="{{ old('keterangan_peminjaman') }}">
                                            <div class="invalid-feedback">
                                                Silahkan Masukan Keterangan
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn btn-success" type="submit">Konfirmasi</button>
                                    </div>
                                @endif
                            @elseif(auth()->user()->role_id == 3)
                                @if ($peminjaman->status_peminjaman_id == 2)
                                    <div class="form-group row">
                                        <label for="keterangan_peminjaman" class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('keterangan_peminjaman') is-invalid @enderror" name="keterangan_peminjaman" id="keterangan_peminjaman" placeholder="Masukan Keterangan" autocomplete="off" value="{{ old('keterangan_peminjaman') }}">
                                            <div class="invalid-feedback">
                                                Silahkan Masukan Keterangan
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn btn-success" type="submit">Konfirmasi</button>
                                    </div>
                                @endif
                            @endif
                            
                        @else
                        <div class="form-group row">
                            <label class="col-xl-3 col-md-3">Status Peminjaman</label>
                            <div class="col-xl-9 col-md-9">
                                <b>{{$peminjaman->statuspeminjaman->nama_status_peminjaman}}</b>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@extends('user.layouts.login')

@section('title','E-BonPinjam | Lacak Peminjaman')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10 col-md-9">
            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-4 text-black">
                        <div class="text-center">
                            <h4 class="h4 text-black mb-4">Lacak Pengajuan</h4>
                            <div class="text-left mb-3">
                                Masukan Kode Peminjaman yang didapat setelah melakukan pengajuan peminjaman barang bukti.
                            </div>
                        </div>

                        <form action="/e-bonpinjam/lacak" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="kode_peminjaman" class="form-control @error('kode_peminjaman') is-invalid @enderror" placeholder="Masukan Kode Peminjaman" placeholder="Masukan Alamat Kode Peminjaman" value="{{old('kode_peminjaman')}}">
                                <div class="invalid-feedback">
                                    Silahkan Masukan Kode Peminjaman
                                </div>
                            </div>

                            <div class="text-center mb-5">
                                <button type="submit" class="btn btn-brown">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Kode Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->kode_peminjaman}}</b>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Keterangan Peminjaman</label>
                            <div class="col-xl-8 col-md-9">
                                <b>{{$peminjaman->keterangan_peminjaman ?? '-'}}</b>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-4 col-md-3">Status Peminjaman</label>
                        </div>
                        <hr>
                        <div class="mb-3">
                            @if ($peminjaman->status_peminjaman_id == '1')
                                @include('user.pages.lacak.step.diproses')
                            @elseif ($peminjaman->status_peminjaman_id == '2')
                                @include('user.pages.lacak.step.disetujuiadmin')
                            @elseif ($peminjaman->status_peminjaman_id == '3')
                                @include('user.pages.lacak.step.disetujuijaksa')
                            @elseif ($peminjaman->status_peminjaman_id == '4')
                                @include('user.pages.lacak.step.ditolakadmin')
                            @elseif ($peminjaman->status_peminjaman_id == '5')
                                @include('user.pages.lacak.step.ditolakjaksa')
                            @elseif ($peminjaman->status_peminjaman_id == '6')
                                @include('user.pages.lacak.step.selesai')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
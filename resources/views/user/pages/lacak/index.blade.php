@extends('user.layouts.login')

@section('title','E-BonPinjam | Lacak Peminjaman')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10 col-md-9">
            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="text-center">
                            <h1 class="h4 text-black mb-4">Lacak Peminjaman</h1>
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

                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-brown">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
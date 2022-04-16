@extends('admin.layouts.admin')

@section('title','Laporan | E-Bonpinjam')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Laporan Peminjaman</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-header bg-gray-300">
                    <div>
                        <h5 class="text-black">Laporan Berdasarkan Tanggal</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form name="form_cetak" action="/e-bonpinjam/admin/laporan" method="POST">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="text-black">Status Peminjaman</label>
                            <select type="text" class="form-control col-sm-6 @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                <option value="semua">Semua</option>
                                @foreach (\App\StatusPeminjaman::orderBy('id','asc')->get() as $stat)
                                    <option value="{{ $stat->id }}" @if (old('status_peminjaman_id') == "$stat->id") {{ 'selected' }} @endif>{{ $stat->nama_status_peminjaman }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-black">Tanggal Peminjaman</label>
                            <div class="form-inline">
                                <div class="form-group mb-2">
                                    <input type="date" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                                </div>
                                <div class="form-group mb-2 ml-1">
                                    -
                                </div>
                                <div class="input-group mb-2">
                                    <input type="date" class="form-control ml-1" name="tgl_akhir" placeholder="Tanggal Akhir">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary search" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-header bg-gray-300">
                    <div>
                        <h5 class="text-black">Laporan Keseluruhan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form name="form_cetak_semua" action="/e-bonpinjam/admin/laporan" method="POST" target="_blank">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="text-black">Status Peminjaman</label>
                            <select type="text" class="form-control col-sm-6 @error('status_peminjaman_id') is-invalid @enderror" name="status_peminjaman_id" id="status_peminjaman_id">
                                <option value="semua">Semua</option>
                                @foreach (\App\StatusPeminjaman::orderBy('id','asc')->get() as $stat)
                                    <option value="{{ $stat->id }}" @if (old('status_peminjaman_id') == "$stat->id") {{ 'selected' }} @endif>{{ $stat->nama_status_peminjaman }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left">
                            <button type="button" class="btn btn-primary semua"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="list-date">

    </div>
    
</div>

@endsection

<!-- KITA GUNAKAN LIBRARY DATERANGEPICKER -->
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).on('click', '.search', function(){
    var tgl_awal = $('input[name=tgl_awal]').val();
    var tgl_akhir = $('input[name=tgl_akhir]').val();
    if(tgl_awal == '' && tgl_akhir == ''){
        Swal.fire("Terjadi Kesalahan", "Kolom Tanggal Peminjaman Harus Diisi", "error");
    }else if(tgl_awal == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Tanggal Awal", "error");
    }else if(tgl_akhir == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Tanggal Akhir", "error");
    }else{
        $('form[name=form_cetak]').submit();
    }
});

$(document).on('click', '.semua', function(){
    $('form[name=form_cetak_semua]').submit();
});

$(document).on('submit', 'form[name=form_cetak]', function(e){
e.preventDefault();
var request = new FormData(this);
$.ajax({
    url: "{{ url('/e-bonpinjam/admin/laporan/ambildata') }}",
    method: "POST",
    data: request,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
        if(data.success==false){
            Swal.fire('Gagal','Data Peminjaman Tidak Ditemukan','error');
        }else{
            $('.list-date').html(data);
        }
    }
    });
});
</script>
@endsection
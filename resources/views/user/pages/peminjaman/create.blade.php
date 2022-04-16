@extends('user.layouts.master')

@section('title',' Tambah Data Peminjaman')
    
@section ('content')
<!-- Begin Page Content -->
<div class="bg-grey">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-md my-5 text-black">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <h1 class="h3 mb-5">Tambah Pengajuan Peminjaman</h1>
                        <form name="filter_form" method="POST" action="/e-bonpinjam/user/tambah" id="form_tambah_peminjaman">
                        @csrf
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kode_peminjaman">Kode Peminjaman</label>
                                    <input type="text" class="form-control" name="kode_peminjaman" id="kode_peminjaman" placeholder="Kode Peminjaman" value="{{ $kodePeminjaman }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_peminjam">Nama Peminjam</label>
                                    <input class="form-control" name="nama_peminjam" id="nama_peminjam" value="{{ $user->nama_masyarakat }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_peminjam">NIK</label>
                                    <input class="form-control" name="nik_peminjam" id="nik_peminjam" value="{{ $user->nik_masyarakat }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat_peminjam">Alamat Peminjam</label>
                                    <input class="form-control" name="alamat_peminjam" id="alamat_peminjam" value="{{ $user->alamat }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_terdakwa"  class="col-xl-2 col-md-3 col-form-label">Cari Terdakwa</label>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="nama_terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                                    <div class="col-sm-4">
                                        {{-- <input type="text" class="mb-1 form-control @error('nama_terdakwa') is-invalid @enderror" name="nama_terdakwa" id="nama_terdakwa" placeholder="Nama Terdakwa" value="{{ old('nama_terdakwa') }}" autocomplete="off" autofocus> --}}
                                        <input type="text" class="mb-1 form-control @error('nama_terdakwa') is-invalid @enderror" name="nama_terdakwa" id="nama_terdakwa" placeholder="Nama Terdakwa" value="terdakwa" autocomplete="off" autofocus>
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Nama Terdakwa
                                        </div>
                                    </div>
        
                                    <div class="col-sm-2">
                                        <select type="text" class="mb-1 form-control @error('keluarga_id') is-invalid @enderror" name="keluarga_id" id="keluarga_id">
                                            @foreach (\App\Keluarga::orderBy('keluarga','asc')->get() as $kel)
                                                <option value="{{ $kel->id }}" @if (old('keluarga_id') == "$kel->id") {{ 'selected' }} @endif>{{ $kel->keluarga }}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                    <div class="col-sm-4">
                                        {{-- <input type="text" class="mb-1 form-control @error('orangtua_terdakwa') is-invalid @enderror" name="orangtua_terdakwa" id="orangtua_terdakwa" placeholder="Nama Orang Tua" value="{{ old('orangtua_terdakwa') }}" autocomplete="off"> --}}
                                        <input type="text" class="mb-1 form-control @error('orangtua_terdakwa') is-invalid @enderror" name="orangtua_terdakwa" id="orangtua_terdakwa" placeholder="Nama Orang Tua" value="orang tua" autocomplete="off">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Nama Orang Tua
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tkp_desa" class="col-sm-2 col-form-label">TKP</label>
                                    <div class="col-sm-4">
                                        {{-- <input type="text" class="mb-1 form-control @error('tkp_desa') is-invalid @enderror" name="tkp_desa" id="tkp_desa" placeholder="Desa" value="{{ old('tkp_desa') }}" autocomplete="off"> --}}
                                        <input type="text" class="mb-1 form-control @error('tkp_desa') is-invalid @enderror" name="tkp_desa" id="tkp_desa" placeholder="Desa" value="desa" autocomplete="off">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Desa TKP
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        {{-- <input type="text" class="mb-1 form-control @error('tkp_kecamatan') is-invalid @enderror" name="tkp_kecamatan" id="tkp_kecamatan" placeholder="Kecamatan" value="{{ old('tkp_kecamatan') }}" autocomplete="off"> --}}
                                        <input type="text" class="mb-1 form-control @error('tkp_kecamatan') is-invalid @enderror" name="tkp_kecamatan" id="tkp_kecamatan" placeholder="Kecamatan" value="kecamatan" autocomplete="off">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Kecamatan TKP
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-secondary btn-filter" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-date">
                            
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-5 mb-1">
                                <a href="/e-bonpinjam/user" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
                            </div>
                            <div class="col-md-7 mb-1">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#tambahpengajuan">Tambah</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahpengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">PERHATIAN!!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pastikan bahwa data yang Anda masukan sudah benar! <br> Pengajuan tidak dapat diubah apabila Anda sudah klik tombol "Tambah"
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary save" id="F" type="submit">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).on('click', '.btn-filter', function(){
    var nama_terdakwa = $('input[name=nama_terdakwa]').val();
    var orangtua_terdakwa = $('input[name=orangtua_terdakwa]').val();
    var tkp_desa = $('input[name=tkp_desa]').val();
    var tkp_kecamatan = $('input[name=tkp_kecamatan]').val();
    if(nama_terdakwa == '' && orangtua_terdakwa == ''){
        Swal.fire("Terjadi Kesalahan", "Kolom Cari Terdakwa Harus Terisi Semua", "error");
    }else if(nama_terdakwa == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Nama Terdakwa", "error");
    }else if(orangtua_terdakwa == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Nama Orang Tua", "error");
    }else if(tkp_desa == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom TKP Desa", "error");
    }else if(tkp_kecamatan == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom TKP Kecamatan", "error");
    }else{
        $('form[name=filter_form]').submit();
    }
});

$(document).on('submit', 'form[name=filter_form]', function(e){
e.preventDefault();
var request = new FormData(this);
$.ajax({
    url: "{{ url('/e-bonpinjam/user/tambah/ambildata') }}",
    method: "POST",
    data: request,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
        if(data.success==false){
            Swal.fire('Gagal','Data Terdakwa Tidak Ditemukan','error')
            .then(function() {
                    // Redirect the user
                    window.location.href = "/e-bonpinjam/user/tambah";
                });
        }else{
            $('.list-date').html(data);
        }
    }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".save").click(function(e){

    e.preventDefault();

    var kode_peminjaman = $("input[name=kode_peminjaman]").val();
    var nama_peminjam = $("input[name=nama_peminjam]").val();
    var nik_peminjam = $("input[name=nik_peminjam]").val();
    var alamat_peminjam = $("input[name=alamat_peminjam]").val();
    var terdakwa_id = $("input[name=terdakwa_id]").val();
    var barang_bukti_id = $('input[type=checkbox]:checked');
    var url = "{{ url('/e-bonpinjam/user/tambah')}}";
    let barbukIds = []
    console.log('elements',barang_bukti_id)
    barang_bukti_id.map((index,item)=> {
        barbukIds.push($(item).val())
    })
    console.log('ids:',barbukIds);

    var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
    
    $.ajax({
        url:url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:'POST',
        data:{
            kode_peminjaman:kode_peminjaman,
            nama_peminjam:nama_peminjam,
            nik_peminjam:nik_peminjam,
            alamat_peminjam:alamat_peminjam,
            terdakwa_id:terdakwa_id,
            barang_bukti_id:barbukIds,
        },
        beforeSend: function() {
            swal.fire({
                html: '<h5>Pengajuan dalam proses...</h5>',
                showConfirmButton: false,
                allowEscapeKey: false,
                allowOutsideClick: false,
                
                onRender: function() {
                    // there will only ever be one sweet alert open.
                    $('.swal2-content').prepend(sweet_loader);
                }
            });
        },
        success:function(response){
            if (response.success === true) {
                Swal.fire({
                    title: "Berhasil!",
                    text: response.message,
                    icon: "success"
                }).then(function() {
                    // Redirect the user
                    window.location.href = "/e-bonpinjam/user";
                });
            }
        },
        error:function(response){
            Swal.fire({
                title: "Gagal",
                text: "Data Pengajuan Peminjaman Harus Terisi Lengkap",
                icon: "error"
            }).then(function() {
                // Redirect the user
                window.location.href = "/e-bonpinjam/user/tambah";
            });
        }
    });
});
</script>
@endsection
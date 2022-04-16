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
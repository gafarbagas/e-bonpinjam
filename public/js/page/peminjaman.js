$(document).on('click', '.btn-filter', function(){
    var nama_tersangka = $('input[name=nama_tersangka]').val();
    var orangtua_tersangka = $('input[name=orangtua_tersangka]').val();
    var tkp_desa = $('input[name=tkp_desa]').val();
    var tkp_kecamatan = $('input[name=tkp_kecamatan]').val();
    if(nama_tersangka == '' && orangtua_tersangka == ''){
        Swal.fire("Terjadi Kesalahan", "Kolom Cari Tersangka Harus Terisi Semua", "error");
    }else if(nama_tersangka == ''){
        Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Nama Tersangka", "error");
    }else if(orangtua_tersangka == ''){
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
    url: "{{ url('/e-bonpinjam/tambah/ambildata') }}",
    method: "POST",
    data: request,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
        if(data.success==false){
            Swal.fire('Gagal','Data Tersangka Tidak Ditemukan','error');
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
    var tersangka_id = $("input[name=tersangka_id]").val();
    var barang_bukti_id = $('input[type=checkbox]:checked');
    var url = "{{ url('/e-bonpinjam/tambah')}}";
    let barbukIds = []
    console.log('elements',barang_bukti_id)
    barang_bukti_id.map((index,item)=> {
        barbukIds.push($(item).val())
    })
    console.log('ids:',barbukIds);

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
            tersangka_id:tersangka_id,
            barang_bukti_id:barbukIds,
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
                // window.location = '/';

                // // how to return the location first, then popping up sweetalert2

                // Swal.fire({
                //     title: 'Berhasil',
                //     text: "Peminjaman berhasil diajukan",
                //     icon: 'success',
                // });
            } else {
                swal.fire("Error!", "error", "error");
            }
        },
        error:function(error){
            console.log(error)
        }
    });
});
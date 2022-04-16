@extends('user.layouts.master')

@section('title','Ubah Password')
    
@section ('content')
<!-- Begin Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-md my-5 text-black mx-auto justify-content-center">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col text-sm-left">
                                <h1 class="h3">Ubah Password</h1>
                            </div>
                        </div>
                        <form id="ubahpassword" action="/e-bonpinjam/user/ubahpassword" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="katasandi" class="col-sm-4 col-form-label">Kata Sandi Sekarang</label>
                                <div class="col-sm">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="currentpassword" id="katasandi" placeholder="Kata Sandi">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan Kata Sandi
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="katasandibaru" class="col-sm-4 col-form-label">Kata Sandi Baru</label>
                                <div class="col-sm">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="newpassword" id="katasandibaru" placeholder="Password">
                                    <div class="invalid-feedback">
                                        Silahkan Masukan Kata Sandi Baru
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <a href="/e-bonpinjam/user/profil" class="btn btn-secondary" type="submit"><i class="fa fa-times"></i> Batal</a>
                                </div>
                                <div class="col-md-7">
                                    <button class="btn btn-primary ubah" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).on('click', '.ubah', function(){
        var currentpassword = $('input[name=currentpassword]').val();
        var newpassword = $('input[name=newpassword]').val();
        if(currentpassword == '' && newpassword == ''){
            Swal.fire("Terjadi Kesalahan", "Semua Kolom Harus Terisi", "error");
        }else if(currentpassword == ''){
            Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Kata Sandi Sekarang", "error");
        }else if(newpassword == ''){
            Swal.fire("Terjadi Kesalahan", "Silahkan Isi Kolom Kata Sandi Baru", "error");
        }else{
            $('#ubahpassword').submit();
        }
    });
</script>
@endsection
@extends('admin.layouts.admin')

@section('title','Data Master | E-Bonpinjam')
    
@section('style')
    <link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Data Master</h1>
    </div>

    <!-- Content Row -->
    <div class="row text-black mb-3">
        <div class="col-md">
            <div class="card border-left-red">
                <div class="card-header">
                    <h4>Batas Waktu Proses</h4>
                </div>
                <div class="card-body">
    
                    <div class="table-responsive">
                        <table class="table-sm text-black" width="200px" cellspacing="0">
    
                            <tbody>
                                @foreach ($batasPinjam as $batas)
                                    <tr>
                                        <td>{{ $batas -> batas_pinjam }} hari</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info shadow-sm mb-1" data-toggle="modal" data-target="#ubah{{$batas->id}}"><i class="fa fa-pencil-alt"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="ubah{{$batas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Batas Waktu Proses</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <form action="/e-bonpinjam/admin/datamaster/bataswaktu/{{$batas->id}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="batas_pinjam" class="col-sm-5 col-form-label">Batas Waktu Proses</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control @error('batas_pinjam') is-invalid @enderror" name="batas_pinjam" id="batas_pinjam" value="{{ $batas->batas_pinjam }}">
                                                            <div class="invalid-feedback">
                                                                Silahkan Masukan Batas Pinjam
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-4 col-form-label">Hari</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-black mb-3">
        <div class="col-md">
            <div class="card border-left-red">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kategori</th>
                                    <th>Kode Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $kategoris)
                                    <tr class="text-black">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $kategoris -> nama_kategori }}</td>
                                        <td>{{ $kategoris -> kode_kategori }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info shadow-sm mb-1" data-toggle="modal" data-target="#edit{{$kategoris->id}}"><i class="fa fa-pencil-alt"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit{{$kategoris->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <form action="/e-bonpinjam/admin/datamaster/kategori/{{$kategoris->id}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="nama_kategori" class="col-sm-4 col-form-label">Nama Kategori</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" id="nama_kategori" value="{{ $kategoris->nama_kategori }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kode_kategori" class="col-sm-4 col-form-label">Kode Kategori</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" name="kode_kategori" id="kode_kategori" value="{{ $kategoris->kode_kategori }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection





@section('script')
<!-- data tables -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#projecttable').DataTable({
            "lengthMenu": [[5,10,25,50,-1], [5,10,25,50,"All"]],
            "language": {
            "sEmptyTable":   "Tidak ada data",
            "sProcessing":   "Sedang memproses...",
            "sLengthMenu":   "Tampilkan _MENU_ data",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "<",
                "sNext":     ">",
                "sLast":     "Terakhir"
            }
        }
        });
    });
</script>

<script>
    $('#hapus_jaksa').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Jaksa yang sudah dihapus tidak akan bisa kembali!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#888888',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#hapus_jaksa_form').submit();
            }
        })
    });
</script>
@endsection
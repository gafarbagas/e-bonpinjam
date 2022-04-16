@extends('admin.layouts.admin')

@section('title','Jaksa | E-Bonpinjam')
    
@section('style')
    <link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Jaksa</h1>
    </div>

    <!-- Content Row -->
    <div class="row text-black">
        <div class="col-md">
            <div class="card border-left-red">
                @if (auth()->user()->role_id != '3')
                    <div class="card-header py-3">
                        <a href="{{route('tambahjaksa')}}" class="btn btn-brown btn-icon-split btn-sm mb-1">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a>
                    </div>
                @endif

                <div class="card-body">
    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-black" width="100%" cellspacing="0" id="projecttable">
                            <thead class="thead">
                                <tr>
                                    <th width=25px>No.</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Pangkat</th>
                                    @if (auth()->user()->role_id != '3')
                                        <th width=53px>Aksi</th>    
                                    @endif
                                    
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($jaksas as $jaksa)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $jaksa -> nrp_jaksa }}</td>
                                        <td>{{ $jaksa -> nama_jaksa }}</td>
                                        <td>{{ $jaksa -> jabatan}}</td>
                                        <td>{{ $jaksa -> pangkat }}</td>
                                        @if (auth()->user()->role_id != '3')
                                        <td>
                                            <a href="/e-bonpinjam/admin/jaksa/{{Crypt::encrypt($jaksa->id)}}/ubah" class="btn btn-sm btn-info shadow-sm mb-1"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="/e-bonpinjam/admin/jaksa/{{\Crypt::encrypt($jaksa->id)}}/hapus" class="btn btn-sm btn-danger mb-1 delete-confirm"><i class="fa fa-trash"></i></a>
                                        </td>
                                        @endif
                                    </tr>
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
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Harap periksa kembali. Data yang akan dihapus tidak akan bisa kembali!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: '#888888',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
            else if ( result.dismiss === Swal.DismissReason.cancel){
                // Swal.fire('Dibatalkan','Data Anda Tersimpan Aman','error');
            }
        });
    });
</script>
@endsection
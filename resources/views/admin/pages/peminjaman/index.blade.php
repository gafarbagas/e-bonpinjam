@extends('admin.layouts.admin')

@section('title','Peminjaman | E-Bonpinjam')
    
@section('style')
    <link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Peminjaman</h1>
    </div>

    <!-- Content Row -->
    <div class="row text-black">
        <div class="col-md">
            <div class="card border-left-red">
                @if (auth()->user()->role_id != '3')
                    <div class="card-header py-3">
                        <a href="{{route('tambahpeminjaman')}}" class="btn btn-brown btn-icon-split btn-sm mb-1">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a>
                        <a href="{{route('blankopeminjaman')}}" target="_blank" class="btn btn-brown btn-icon-split btn-sm mb-1">
                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Unduh Blanko Kosong</span>
                        </a>
                        {{-- <a href="#"target="_blank" class="btn btn-brown btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Laporan</span>
                        </a> --}}
                    </div>
                @endif

                <div class="card-body">
    
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover table-sm text-black" width="100%" cellspacing="0" id="projecttable">
                            <thead class="thead">
                                <tr>
                                    <th width=25px>No.</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Jaksa</th>
                                    <th>Status Pengajuan</th>
                                    <th>Keterangan</th>
                                    @if (auth()->user()->role_id != 3)
                                        <th width=100px>Aksi</th>
                                    @else
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($peminjamans as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $peminjaman->kode_peminjaman }}</td>
                                        {{-- <td><a href="#" type="button" data-toggle="modal" data-target="#detail{{$peminjaman->id}}">{{ $peminjaman->nama_peminjam }}</a></td> --}}
                                        <td>{{ $peminjaman->nama_peminjam }}</td>
                                        <td>{{ Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('l, d F Y') }}</td>
                                        <td>{{ $peminjaman->terdakwa->jaksa->nama_jaksa }}</td>
                                        <td>{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</td>
                                        <td>{{ $peminjaman->keterangan_peminjaman}}</td>
                                        <td>
                                            <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/konfirmasi" class="btn btn-sm btn-success shadow-sm mb-1"><i class="fa fa-check"></i></a>
                                            @if (auth()->user()->role_id != 3)
                                                <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/laporan" target="_blank" class="btn btn-sm btn-primary shadow-sm mb-1"><i class="fa fa-print"></i></a>
                                                <a href="/e-bonpinjam/admin/peminjaman/{{\Crypt::encrypt($peminjaman->id)}}/hapus" class="btn btn-sm btn-danger mb-1 delete-confirm"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
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
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
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
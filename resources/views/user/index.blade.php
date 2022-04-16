@extends('user.layouts.master')

@section('title','E-Bonpinjam')
    
@section('style')
    <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('vendor/datatables/rowReorder.dataTables.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('vendor/datatables/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
            <div class="col-xl my-5">
                @if ($user->foto_ktp == NULL)
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="alert alert-light text-black2" >
                                <button class="btn btn-sm btn-circle btn-outline-info" disabled><i class="fas fa-info"></i></button>
                                Lengkapi foto KTP pada profil Anda terlebih dahulu. 
                                <a href="/e-bonpinjam/user/ubahprofil/{{\Crypt::encrypt($user->id)}}" class="btn btn-sm btn-info shadow-sm mb-1">Klik disini</a> 
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-dark text-uppercase mb-1">Jumlah Peminjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-dark">{{$peminjaman}}</div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard fa-2x dark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row text-black">
            <div class="col-md mb-5">
                <div class="card">
                    <div class="card-header py-3 align-items-center">
                        <a href="{{url('/e-bonpinjam/user/tambah')}}" class="btn btn-brown btn-icon-split btn-sm mb-1">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Ajukan Peminjaman</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table">
                            <table class="table table-bordered table-hover table-sm text-black" cellspacing="0" id="projecttable">
                                <thead class="thead">
                                    <tr>
                                        <th width=25px>No.</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Status Pengajuan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th width=40%>Keterangan</th>
                                        {{-- @if (auth()->user()->role_id != '2') --}}
                                        <th>Aksi</th>    
                                        {{-- @endif --}}
                                        
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($peminjamans as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $peminjaman->kode_peminjaman }}</td>
                                            <td>
                                                @if ($peminjaman->status_peminjaman_id === 1)
                                                    <span class="badge badge-pill badge-secondary">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                                @elseif ($peminjaman->status_peminjaman_id === 2)
                                                    <span class="badge badge-pill badge-info">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                                @elseif ($peminjaman->status_peminjaman_id === 3)
                                                    <span class="badge badge-pill badge-success">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                                @elseif ($peminjaman->status_peminjaman_id === 6)
                                                    <span class="badge badge-pill badge-brown">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ $peminjaman->statuspeminjaman->nama_status_peminjaman}}</span>
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->translatedFormat('l, d F Y') }}</td>
                                            <td>{{ $peminjaman->keterangan_peminjaman ?? '-'}}</td>
                                            {{-- <td>
                                            @foreach ($peminjaman->pinjambarbuk as $barbuk)
                                                {{$barbuk->bb->nama_barangbukti}}
                                            @endforeach    
                                            </td> --}}
                                            @if ($peminjaman->status_peminjaman_id == 3)
                                                <td width=70px>
                                            @else
                                                <td width=30px>
                                            @endif
                                                <a href="/e-bonpinjam/user/detail/{{\Crypt::encrypt($peminjaman->id)}}" class="btn btn-circle btn-sm btn-secondary shadow-sm mb-1"><i class="fa fa-eye"></i></a>
                                                @if ($peminjaman->status_peminjaman_id == 3)
                                                    <a href="/e-bonpinjam/user/cetak/{{\Crypt::encrypt($peminjaman->id)}}" target="_blank" class="btn btn-sm btn-primary shadow-sm mb-1"><i class="fa fa-print"></i></a>
                                                @endif
                                            </td>
                                            {{-- @endif --}}
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

    <div class="container">
        <div class="row">
            <div class="col mb-5">
                <div class="card">
                    <div class="card-body text-black2">
                        <h3 class="font-weight-bold text-center mb-4 text-uppercase">Petunjuk Penggunaan</h3>
                        <div class="row">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2 border-left-brown">
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-xl-1">
                                                <div class="font-weight-bold text-uppercase h1">1</div>
                                            </div>
                                            
                                            <div class="col-xl-11 text-left">
                                                <h4><b>STATUS PENGADUAN</b><br></h4>
                                                Terdapat 6 status pengajuan peminjaman: <br>
                                                1. <span class="badge badge-pill badge-secondary">Diproses</span> Pengajuan peminjaman sudah diterima dan dalam proses pengecekan. <br>
                                                2. <span class="badge badge-pill badge-info">Disetujui Admin</span> Pengecekan telah dilakukan dan disetujui oleh Admin. <br>
                                                3. <span class="badge badge-pill badge-danger">Ditolak Admin</span> Pengecekan telah dilakukan namun ditolak oleh Admin karena suatu alasan. <br>
                                                4. <span class="badge badge-pill badge-success">Disetujui Jaksa</span> Pengajuan telah disetujui oleh Admin. <br>
                                                5. <span class="badge badge-pill badge-danger">Ditolak Jaksa</span> Pengajuan ditolak oleh Jaksa karena alasan tertentu. <br>
                                                6. <span class="badge badge-pill badge-brown">Selesai</span> Barang bukti yang dipinjam sudah diterima oleh pengguna. <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2 border-left-brown">
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-xl-1">
                                                <div class="font-weight-bold text-uppercase h1">2</div>
                                            </div>
                                            
                                            <div class="col-xl-11 text-left">
                                                <h4><b>CARA PENGADUAN</b><br></h4>
                                                Klik tombol "Tambah Peminjaman". Cari terlebih dahulu terdakwa yang memiliki barang bukti yang akan dipinjam. Setelah terdakwa berhasil ditemukan, pilih barang bukti yang akan dipinjam. Selanjutnya tunggu proses konfirmasi dari admin dan jaksa. Apabila proses konfirmasi telah dilakukan, akan ada e-mail pemberitahuan dari sistem yang akan masuk ke e-mail akun anda.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.rowReorder.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#projecttable').DataTable({
                "responsive":true,
                "lengthMenu": [[5,10,25,50,-1], [5,10,25,50,"All"]],
                "language": {
                "sEmptyTable":   "Tidak ada data peminjaman",
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
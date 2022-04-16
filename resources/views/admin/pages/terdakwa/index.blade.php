@extends('admin.layouts.admin')

@section('title','Terdakwa | E-Bonpinjam')
    
@section('style')
    <link rel="stylesheet" href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section ('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-3 mt-4">
        <h1 class="h3 text-black">Terdakwa</h1>
    </div>

    <!-- Content Row -->
    <div class="row text-black">
        <div class="col-md">
            <div class="card border-left-red">
                @if (auth()->user()->role_id != '3')
                    <div class="card-header py-3">
                        <a href="{{route('tambahterdakwa')}}" class="btn btn-brown btn-icon-split btn-sm mb-1">
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
                                    <th>Kode Terdakwa </th>
                                    <th>NIK</th>
                                    <th>Nama Terdakwa</th>
                                    <th>Nama Jaksa</th>
                                    {{-- <th>Alamat</th> --}}
                                    {{-- <th>No. Telepon</th> --}}
                                    @if (auth()->user()->role_id != '3')
                                        <th width=100px>Aksi</th>    
                                    @endif
                                    
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($terdakwas as $terdakwa)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $terdakwa -> kode_terdakwa }}</td>
                                        <td>{{ $terdakwa -> nik_terdakwa }}</td>
                                        <td>{{ ucfirst($terdakwa -> nama_terdakwa) }} {{ $terdakwa->keluarga->keluarga}} {{ ucfirst($terdakwa -> orangtua_terdakwa) }}</td>
                                        <td>{{ $terdakwa->jaksa->nama_jaksa }}</td>
                                        @if (auth()->user()->role_id != '3')
                                        <td>
                                            <button type="button" class="btn btn-sm btn-secondary shadow-sm mb-1" data-toggle="modal" data-target="#detail{{$terdakwa->id}}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="/e-bonpinjam/admin/terdakwa/{{\Crypt::encrypt($terdakwa->id)}}/ubah" class="btn btn-sm btn-info shadow-sm mb-1"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="/e-bonpinjam/admin/terdakwa/{{\Crypt::encrypt($terdakwa->id)}}/hapus" class="btn btn-sm btn-danger mb-1 delete-confirm"><i class="fa fa-trash"></i></a>
                                        </td>
                                        @endif
                                    </tr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detail{{$terdakwa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Terdakwa</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Kode Terdakwa</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa -> kode_terdakwa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Nama Jaksa</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->jaksa->nama_jaksa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">NIK</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->nik_terdakwa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Nama Terdakwa</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm text-capitalize">{{ $terdakwa -> nama_terdakwa }} {{ $terdakwa->keluarga->keluarga}} {{ $terdakwa -> orangtua_terdakwa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Tempat Lahir</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->tempat_lahir }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Tanggal Lahir</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ Carbon\carbon::parse($terdakwa->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">TKP Desa</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->tkp_desa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">TKP Kecamatan</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->tkp_kecamatan }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Agama</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->agama->nama_agama }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Alamat</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm text-capitalize">{{ $terdakwa->alamat_terdakwa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Pekerjaan</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->pekerjaan_terdakwa }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Kewarganegaraan</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->kewarganegaraan->nama_kewarganegaraan }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label class="col-sm-4">Pendidikan</label>
                                                        <label class="d-none d-sm-inline col-sm-1">:</label>
                                                        <div class="col-sm">{{ $terdakwa->pendidikan->nama_pendidikan }}</div>
                                                    </div>
                                                </div>
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
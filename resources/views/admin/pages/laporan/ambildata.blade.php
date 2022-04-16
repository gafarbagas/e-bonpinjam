<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-body">
                <div class="mb-2">
                    <h3 class="text-black">Data Peminjaman</h3>
                    <div class="row">
                        <div class="col-11">
                            <p class="text-black">Periode {{\Carbon\Carbon::parse($tgl_awal)->translatedFormat('j F Y')}} s/d {{\Carbon\Carbon::parse($tgl_akhir)->translatedFormat('j F Y')}}</p>
                        </div>
                        <div class="col-1">
                            <a href="/e-bonpinjam/admin/laporan/{{$status}}/{{$tgl_awal}}/{{$tgl_akhir}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- TAMPILKAN DATA YANG BERHASIL DIFILTER -->
                    <table class="table table-hover table-sm table-bordered text-black">
                        <thead>
                            <tr>
                                <th>Kode Peminjaman</th>
                                <th>Nama Peminjam</th>
                                <th>Terdakwa</th>
                                <th>Status Peminjaman</th>
                                <th>Tanggal Peminjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $row)
                            <tr>
                                <td><strong>{{ $row->kode_peminjaman }}</strong></td>
                                <td>{{ $row->nama_peminjam }}</td>
                                <td>
                                    {{ ucfirst($row->terdakwa->nama_terdakwa) }} {{ $row->terdakwa->keluarga->keluarga }} {{ ucfirst($row->terdakwa->orangtua_terdakwa) }}<br>
                                    <strong>Nama Jaksa</strong>: {{ $row->terdakwa->jaksa->nama_jaksa }}
                                </td>
                                <td>{{ $row->statuspeminjaman->nama_status_peminjaman}}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl_peminjaman)->translatedFormat('d F Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
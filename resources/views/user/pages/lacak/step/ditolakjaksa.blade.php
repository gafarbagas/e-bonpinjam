<div class="form-group row">
    <div class="col-xl-4 col-md-3">
        <div class="row">
            <div class="col btn btn-danger">
                Jaksa
            </div>
        </div>
        <div class="row">
            <div class="col text-xl-right">
                {{\Carbon\Carbon::parse($peminjaman->tgl_konfirmasi_jaksa)->translatedFormat('d-m-Y H:i:s')}}
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-9">
        Pengajuan Anda telah ditolak oleh Jaksa. <br> {{$peminjaman->keterangan_peminjaman ?? '-'}}
    </div>
</div>
<hr>
<div class="form-group row">
    <div class="col-xl-4 col-md-3">
        <div class="row">
            <div class="col btn btn-success">
                Admin
            </div>
        </div>
        <div class="row">
            <div class="col text-xl-right">
                {{\Carbon\Carbon::parse($peminjaman->tgl_konfirmasi_admin)->translatedFormat('d-m-Y H:i:s')}}
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-9">
        Pengajuan Anda telah disetujui oleh Admin. <br> Pengajuan akan ditinjau oleh Jaksa.
    </div>
</div>
<hr>
<div class="form-group row">
    <div class="col-xl-4 col-md-3">
        <div class="row">
            <div class="col btn btn-warning">
                Masyarakat
            </div>
        </div>
        <div class="row">
            <div class="col text-xl-right">
                {{\Carbon\Carbon::parse($peminjaman->created_at)->translatedFormat('d-m-Y H:i:s')}}
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-9">
        Pengajuan peminjaman barang bukti telah dilakukan. <br> Pengajuan akan ditinjau oleh Admin.
    </div>
</div>

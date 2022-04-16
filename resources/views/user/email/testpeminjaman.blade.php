@component('mail::message')
Pengajuan peminjaman barang bukti Anda berhasil dilakukan. Pengajuan akan segera diproses.

@component('mail::table')
|               |   |
| -------------------- | --------:|
| Kode Peminjaman      | {{$peminjaman->kode_peminjaman}}      |
| Nama Peminjam        | {{$peminjaman->nama_peminjam}}        |
| NIK Peminjam         | {{$peminjaman->nik_peminjam}}         |
| Tanggal Pengajuan    | {{$peminjaman->tgl_peminjaman}}       |
| Nama Terdakwa        | {{$peminjaman->terdakwa->nama_terdakwa}} {{$peminjaman->terdakwa->keluarga->keluarga}} {{$peminjaman->terdakwa->orangtua_terdakwa}}      |
| Nama Jaksa           | {{$peminjaman->terdakwa->jaksa->nama_jaksa}}      |
@endcomponent

{{-- @component('mail::table')
| Kode Peminjaman      | : | {{$peminjaman->kode_peminjaman}}   |
| Nama Peminjam        | : | {{$peminjaman->nama_peminjam}}     |
| NIK Peminjam         | : | {{$peminjaman->nik_peminjam}}      |
| Tanggal Pengajuan    | : | {{$peminjaman->tgl_peminjaman}}    |
| Nama Terdakwa        | : | {{$peminjaman->terdakwa->nama_terdakwa}} {{$peminjaman->terdakwa->keluarga->keluarga}} {{$peminjaman->terdakwa->orangtua_terdakwa}}      |
| Nama Jaksa           | : | {{$peminjaman->terdakwa->jaksa->nama_jaksa}}      |
@endcomponent --}}
{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
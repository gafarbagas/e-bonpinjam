@extends('admin.layouts.report')

@section('title','Laporan Peminjaman')

@section('content')

<p style="text-align: right"><b>BA-20</b></p>
<p style="text-align: center"><b><u><font size=12pt>BERITA ACARA<br>PENGEMBALIAN BARANG BUKTI</font></b></u></p>
<p>Pada hari ini: {{$hari}}  tanggal {{$tanggal}}, bertempat di Kejaksaan Negeri Purwokerto, kami:</p>

<table class="center">
	<tr>
		<td width=85px>Nama</td>
		<td width=1px>:</td>
		<td>{{ $peminjamans->terdakwa->jaksa->nama_jaksa}}</td>
	</tr>
	<tr>
		<td>Pangkat/NRP</td>
		<td>:</td>
		<td>{{ $peminjamans->terdakwa->jaksa->pangkat}}/{{ $peminjamans->terdakwa->jaksa->nrp_jaksa}}</td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td>{{ $peminjamans->terdakwa->jaksa->jabatan}}</td>
	</tr>
</table>

<p>Telah mengembalikan barang bukti berupa:</p>

<table>
	@foreach($peminjamans->pinjambarbuk as $barbuk)
		<tr>
			<td>{{ $loop->iteration }}.</td>
			<td>{{ $barbuk->bb->nama_barangbukti }}</td>
		</tr>
	@endforeach
</table>

<p>Kepada:</p>
<table class="center">
	<tr>
		<td width=85px>Nama</td>
		<td width=1px>:</td>
		<td>{{ $peminjamans->nama_peminjam}}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>{{ $peminjamans->alamat_peminjam}}</td>
	</tr>
</table>

<p>Demikian berita acara ini kami buat dengan sebenarnya atas kekuatan sumpah jabatan, kemudian kami tutup dan tanda tangani pada hari dan tanggal tersebut diatas.</p>
<br>

<table width=100% cellpadding=4px style="text-align: center">
	<tr>
		<td width=50%>YANG MENERIMA<br>BARANG BUKTI</td>
		<td width=50%>YANG MENGEMBALIKAN<br>JAKSA PENUNTUT UMUM</td>
	</tr>
	<tr><td height="75px"></td></tr>
	<tr>
		<td>{{ $peminjamans->nama_peminjam}}</td>
		<td><u>{{ $peminjamans->terdakwa->jaksa->nama_jaksa}}</u><br> {{$peminjamans->terdakwa->jaksa->jabatan}}/{{$peminjamans->terdakwa->jaksa->nrp_jaksa}}</td>
	</tr>
</table>
<br>
<p>SAKSI:</p>
<table class="center">
	<tr>
		<td>{{auth()->user()->name}}</td>
		<td width=150px>(</td>
		<td>)</td>
	</tr>
</table>
@endsection
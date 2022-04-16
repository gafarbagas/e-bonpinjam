@extends('user.layouts.report')

@section('title','Laporan Peminjaman')

@section('content')

<p style="text-align: center"><b><u><font size=12pt>BUKTI PENGAJUAN<br>PEMINJAMAN BARANG BUKTI</font></b></u></p>
<br>
<p>Yang bertanda tangan dibawah ini:</p>

<table>
	<tr>
		<td width=130px>Nama</td>
		<td width=1px>:</td>
		<td>{{ $peminjamans->nama_peminjam}}</td>
	</tr>
	<tr>
		<td>NIK</td>
		<td>:</td>
		<td>{{ $peminjamans->nik_peminjam}}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>{{ $peminjamans->alamat_peminjam}}</td>
	</tr>
</table>

<p>Mengajukan peminjaman barang bukti berupa:</p>

<table>
	@foreach($peminjamans->pinjambarbuk as $barbuk)
		<tr>
			<td>{{ $loop->iteration }}.</td>
			<td>{{ $barbuk->bb->nama_barangbukti }}</td>
		</tr>
	@endforeach
</table>
<p>Sekian, terima kasih.</p>
<br>

<table width=100% cellpadding=4px style="text-align: center">
	<tr>
		<td width=50%></td>
		<td width=50%>Peminjam Barang Bukti</td>
	</tr>
	<tr><td height="75px"></td></tr>
	<tr>
		<td></td>
		<td>{{ $peminjamans->nama_peminjam}}</td>
	</tr>
</table>
@endsection
@extends('admin.layouts.report')

@section('title','Laporan Peminjaman')

@section('content')

<br>
<table class="center1">
    <tr>
        <td><b>FORM PENGAJUAN PEMINJAMAN BARANG BUKTI PERKARA PIDANA</b></td>
    </tr>
</table>

<br>

{{-- <div class="row">
    <div class="col-2">Nama Peminjam</div>
    <div class="col-1">:</div>
    <div class="col-9"></div>
</div> --}}
<p><b>Data Diri Pemohon</b></p>
<table>
    <tr>
        <td width=120px>Nama Pemohon</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>Alamat Pemohon</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>

    <tr>
        <td height="25px"></td>
    </tr>
</table>

<p><b>Data Diri Terdakwa</b></p>

<table>
    <tr>
        <td width=120px>Nama Terdakwa</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Bin/Binti*</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>TKP Desa</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>TKP Kecamatan</td>
        <td>:</td>
        <td>________________________________________________________</td>
    </tr>
</table>
<br>

<p><b>Barang Bukti</b></p>
<table>
    <tr>
        <td>1.</td>
        <td>______________________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>2.</td>
        <td>______________________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
    <tr>
        <td>3.</td>
        <td>______________________________________________________________________</td>
    </tr>
    <tr>
        <td height="5px"></td>
    </tr>
</table>
<br>
<table width=100% cellpadding=4px>
    <tr>
        <td width=55%></td>
        <td width=45%>Purwokerto, <br> Pemohon</td>
    </tr>
    <tr><td height="50px"></td></tr>
    <tr>
        <td></td>
        <td>_____________________________</td>
    </tr>
</table>
<br><br>
<small>* Coret yang tidak perlu</small>

@endsection
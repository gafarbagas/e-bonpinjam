@extends('admin.layouts.report')

@section('title','Laporan Peminjaman')

@section('style')
	<style>
		th{
			text-align: left;
		}
	</style>
@endsection

@section('content')

    <h3>Laporan Peminjaman <br>
        {{$status}} <br>
        @if ($tgl_awal == TRUE)
            {{ \Carbon\Carbon::parse($tgl_awal)->translatedFormat("j F Y") }} - {{ \Carbon\Carbon::parse($tgl_akhir)->translatedFormat("j F Y") }}
        @endif
    </h3>
    <table width="100%" border="1px" style="border-collapse: collapse" cellpadding=4px>
        <tr>
            <th>Kode Peminjaman</th>
            <th>Peminjam</th>
            <th>Terdakwa</th>
            <th>Tanggal</th>
        </tr>
        <tbody>
            @forelse ($peminjaman as $row)
                <tr>
                    <td>{{ $row->kode_peminjaman }}</td>
                    <td>
                        {{ $row->nama_peminjam }}<br>
                        <strong>NIK:</strong> {{ $row->nik_peminjam }}<br>
                        {{-- <strong>Alamat:</strong> {{ $row->alamat_peminjam }}</strong> --}}
                    </td>
                    <td>
                        {{ $row->terdakwa->nama_terdakwa }} {{ $row->terdakwa->keluarga->keluarga }} {{ $row->terdakwa->orangtua_terdakwa }}<br>
                        <strong>Nama Jaksa</strong>: {{ $row->terdakwa->jaksa->nama_jaksa }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_peminjaman)->translatedFormat('d F Y') }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <br>
    <table width=100% cellpadding=4px>
        <tr>
            <td width=55%></td>
            <td width=45%>Purwokerto, {{ \Carbon\Carbon::now()->translatedFormat("j F Y") }} <br> Kepala Kejaksaan Negeri Purwokerto</td>
        </tr>
        <tr><td height="75px"></td></tr>
        <tr>
            <td></td>
            <td><u>Sunarwan S.H., M.Hum.</u> <br> NIP. </td>
        </tr>
    </table>
@endsection
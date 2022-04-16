<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>@yield('title')</title>
	<link rel="shortcut icon" type="image/png" href="{{url('backend/img/logo1.png')}}"/>
	<style>
		body{
			font-family:"Times New Roman", Times, serif;
			font-size: 12pt;
		}
		th, td{
			vertical-align: top
		}
		.container {
			width: 100%;
			padding-right: .75rem;
			padding-left: .75rem;
			margin-right: 1cm;
			margin-left: 1cm
		}
		table.center {
			margin-left: 1cm;
		}
		table.center1 {
			margin-right: auto;
			margin-left: auto;
		}
	</style>
	@yield('style')
</head>
<body>
	
<div class="container">
	<table style="width: 100%">
		<thead>
			<tr>
				<td width=10px><img src="img/logokejaksaan.png" height="100px"> </td>
				<td style="text-align: center;">
					<font size=12pt><b>KEJAKSAAN REPUBLIK INDONESIA</b></font><br>
					<font size=12pt><b>KEJAKSAAN TINGGI JAWA TENGAH</b></font><br>
					<font size=14pt><b> KEJAKSAAN NEGERI PURWOKERTO</b></font><br>
					<font size=10pt> Jalan Jenderal Gatot Soebroto No.109 Purwokerto</font><br>
					<font size=10pt> Telp.(0281) 635590 Fax. (0281) 640540</font><br>
				</td>
			</tr>
		</thead>
	</table>
	<hr>
	
	@yield('content')
</div>


</body>
</html>
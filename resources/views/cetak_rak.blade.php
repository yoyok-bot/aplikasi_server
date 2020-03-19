<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Membuat Laporan PDF </h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Perangkat</th>
				<th>Kapasitas RAM</th>
				<th>Kapasitas HDD</th>
				<th>Status Kepemilikan</th>
				<th>Status Server</th>
			</tr>
		</thead>
		<tbody>
        @if($pegawai->isEmpty())
        <tr><td colspan="6" align="center">Data Tidak ditemukan</td></tr>
        @else
			@php $i=1 @endphp
			@foreach($pegawai as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama_perangkat}}</td>
				<td>{{$p->ukuran_ram}} GB</td>
				<td>{{$p->ukuran_hdd}} {{$p->keterangan}}</td>
				<td>{{$p->status_kepemilikan}}</td>
				<td>{{$p->status_server}}</td>
			</tr>
			@endforeach
            @endif
		</tbody>
	</table>
 
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Iuran</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap" media="print" onload="this.media='all'">
<style>
.text-center {
    text-align:left;
}
</style>
</head>
<body data-rsssl=1>
	<style type="text/css"> table tr td, table tr th{ font-size: 9pt; } </style>
	<center>
		<h5>DESA ADAT TAUKA</h5>
		<h6>LAPORAN IURAN</h6>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Tanggal</th>
				<th>Nominal</th>
				<th>Status</th>
				<th>Anggota</th>
				<th>Jenis Iuran</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@php $total=0 @endphp
			@foreach($iuran as $data)
			@php($total += $data->nominal);
			<tr>
				<td class="text-center">{{ $i++ }}</td>
				<td>{{ tanggal_indonesia($data->tanggal)}}</td>
				<td>@currency($data->nominal)</td>
                @if($data->status=='1')
                    <td>Sudah Bayar</td>
                @else
                    <td>Belum Bayar</td>
                @endif
				<td>{{$data->anggota}}</td>
				<td>{{$data->jenis_iuran}}</td>
			</tr>
			@endforeach
			<tr><td colspan="4" class="text-right" style="font-weight:bold">Total</td>
				<td colspan="2" style="font-weight:bold">@currency($total)</td></tr>
		</tbody>
	</table>

</body>
</html>
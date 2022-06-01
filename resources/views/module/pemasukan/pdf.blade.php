<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pemasukan</title>
	<link rel="stylesheet" href="{{ public_path('assets/css/bootstrap.css') }}" crossorigin="anonymous">
</head>

<body class="bg-white">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

		hr {
			position: relative;
			/* top: 20px; */
			border: none;
			margin: 0px;
			background: black;
			margin-bottom: 50px;
		}

    </style>

    <table class="table">
        <tr>
            <td style="border-top: 0px" class="text-center p-0" width="30%"><img
                    src="{{ public_path('logo_asak.png') }}" alt="Responsive image" width="100px"></td>
            <td style="border-top: 0px; vertical-align:middle" class="text-center p-0">
                <h5 class="py-0 my-0">DESA ADAT ASAK</h5>
                <h6 class="py-0 my-0">LAPORAN PENGELUARAN</h6>
                <p class="py-0 my-0">Jln. Raya Asak Pertima – Karangasem</p>
                <p class="py-0 my-0">(0363) 234-1212</p>
            </td>
            <td style="border-top: 0px" class="text-center p-0"></td>
        </tr>
    </table>
	
    <hr class="mt-0 mb-0" style="height: 2px">
    <hr class="mb-0" style="height: 3px; margin-top: 2px">
    <hr class="mb-2" style="height: 2px; margin-top: 2px">

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Nominal</th>
				<th class="text-center">Status</th>
				<th class="text-center">Jenis Pemasukan</th>
				<th class="text-center">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@php $total=0 @endphp
			@foreach($pemasukan as $data)
			@php($total += $data->nominal);
			<tr>
				<td class="text-center">{{ $i++ }}</td>
				<td>{{ tanggal_indonesia($data->tanggal)}}</td>
				<td>@currency($data->nominal)</td>
                @if($data->status=='1')
                    <td>Sudah Disetujui</td>
                    @else
                    <td>Belum Disetujui</td>
                @endif
				<td class="text-center">{{$data->jenis_pemasukan}}</td>
				<td>{{$data->keterangan}}</td>
				
			</tr>
			@endforeach
			<tr><td colspan="5" class="text-right" style="font-weight:bold">Total</td><td style="font-weight:bold">@currency($total)</td></tr>
		</tbody>
	</table>

	<br><br><br>

    <table style="border: none;" align="right">
        <tr style="border: none;">
            <td width="80%" style="border: none;"></td>
            <td style="border: none; text-align:center;">
                {{ tanggal_indonesia(date('Y-m-d')) }} <br>
                Bendesa
                <br><br><br><br>
                I Nengah wasista Budi Utomo
            </td>
        </tr>
    </table>

</body>
</html>
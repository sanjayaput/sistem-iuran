<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengeluaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap"
        media="print" onload="this.media='all'">
    <style>
        .text-center {
            text-align: left;
        }

    </style>
</head>

<body data-rsssl=1>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <img align="left" src="{{ public_path('logo_asak.png') }}" alt="logo" width="100px">
    <center>
        <h5>DESA ADAT ASAK</h5>
        <h6>LAPORAN PENGELUARAN</h6>
    </center>

    <hr width="100%" size="3">

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Nominal</th>
                <th class="text-center">Status</th>
                <!-- <th class="text-center">Bukti</th> -->
                <th class="text-center">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @php $total=0 @endphp
            @foreach ($pengeluaran as $data)
                @php($total += $data->nominal);
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ tanggal_indonesia($data->tanggal) }}</td>
                    <td>@currency($data->nominal)</td>
                    @if ($data->status == '1')
                        <td>Sudah Disetujui</td>
                    @else
                        <td>Belum Disetujui</td>
                    @endif
                    <!-- @if ($data->bukti != '' || $data->bukti != null)
<td><img src="{{ url('/upload/images/bukti/' . $data->bukti) }}"></td>
@else
<td></td>
@endif -->
                    <td>{{ $data->catatan }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right" style="font-weight:bold">Total</td>
                <td style="font-weight:bold">@currency($total)</td>
            </tr>
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

@extends('layouts.app')
@section('title')
    Grafik Keuangan
@endsection


@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
    </script>
    <script language="JavaScript">
        function drawChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Pemasukan', 'Iuran', 'Pengeluaran'],
                <?php
                    foreach ($data as $row) {
                        echo "['" . $row['month_name'] . "', " . $row['total_pemasukan'] . ', ' . $row['total_iuran'] . ', ' . $row['total_pengeluaran'] . '],';
                    }
                ?>

            ]);

            var options = {
                height: 500,
                legend: {
                    position: 'bottom',
                    textStyle: {
                        fontSize: 12
                    }
                },
                bar: {
                    groupWidth: '95%'
                },
                hAxis: {
                    textStyle: {
                        fontSize: 11
                    }
                },
                vAxis: {
                    gridlines: {
                        count: 4
                    },
                    textStyle: {
                        fontSize: 12
                    }
                }
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('container'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChart);
    </script>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Grafik Keuangan Tahun <?php echo date('Y'); ?></h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" id="container"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

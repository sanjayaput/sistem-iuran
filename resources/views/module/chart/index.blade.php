@extends('layouts.app')
@section('title')
    Grafik Keuangan
@endsection


@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <div class="col-12 row align-items-center">
                        <div class="col-7">
                            <h5 class="card-title">Grafik Keuangan Tahun <span id="chartYear"> <?php echo date('Y'); ?> </span></h5>
                        </div>
                        <div class="col-4">
                            <select name="year" class="form-control" id="" onchange="generateProfitData(this.value)">
                                @forelse ($tahun as $th)
                                    <option value="{{ $th }}" {{ $th == date('Y') ? 'selected' : '' }}>{{ $th }}</option>
                                @empty
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-1">
                            <div class="header-elements float-right">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                    <a class="list-icons-item" data-action="reload"></a>
                                    <a class="list-icons-item" data-action="remove"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="chart" id="financeChart"></div> --}}
                    <canvas height="100" id="financeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('chart.js/Chart.js') }}"></script>
    <script>
        let profit
        generateProfitData()
        const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ]

        function generateProfitData(year = null) {
            const url = "{{ url('chart/generate') }}"
            let formData = year == null ? {
                year: 'now'
            } : {
                year: year
            }
            const chartYear = document.getElementById('chartYear')
            if(year != null){
              chartYear.innerHTML = year
            }
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    if (data.code === 1) {
                        if (year != null) {
                            profit.destroy()
                            profit = generateProfitChart(data)
                        } else {
                            profit = generateProfitChart(data)
                        }
                    }
                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function generateProfitChart(data) {
            const profitChartCanvas = document.getElementById("financeChart").getContext('2d')
            const dataProfit = {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan',
                    data: data.data.pemasukan,
                    borderColor: 'rgb(145,208,246)',
                    backgroundColor: 'rgb(145,208,246)',
                }, {
                    label: 'Pengeluaran',
                    data: data.data.pengeluaran,
                    borderColor: 'rgb(244,174,194)',
                    backgroundColor: 'rgb(244,174,194)',
                }, {
                    label: 'Iuran',
                    data: data.data.iuran,
                    borderColor: 'rgb(252, 186, 3)',
                    backgroundColor: 'rgb(252, 186, 3)',
                }]
            }
            const optionsProfit = {
                // legend: {
                //     display: false
                // },
                elements: {
                    line: {
                        lineTension: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(tooltipItem.yLabel)
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            // stepSize: 100000,
                            callback: function(value, index, values) {
                                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value)
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                }
            }
            var profitChart = new Chart(profitChartCanvas, {
                type: 'bar',
                data: dataProfit,
                options: optionsProfit
            });
            return profitChart
        }
    </script>
@endpush

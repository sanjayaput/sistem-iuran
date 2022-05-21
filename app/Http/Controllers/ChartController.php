<?php

namespace App\Http\Controllers;

use App\Iuran;
use App\Pemasukan;
use Illuminate\Http\Request;
use App\User;
use App\Pengeluaran;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function index(Request $request)
    {
        // $data = DB::select("SELECT a.*, b.total_pengeluaran, c.total_iuran FROM vpemasukan AS a LEFT JOIN vpengeluaran AS b ON b.month_id = a.month_id LEFT JOIN viuran c ON c.month_id = a.month_id");
        // dd($data);

        $tahun_pemasukan = Pemasukan::selectRaw('DISTINCT year(tanggal) year')->orderBy('year', 'DESC')->pluck('year', 'year')->toArray();
        $tahun_pengeluaran = Pengeluaran::selectRaw('DISTINCT year(tanggal) year')->orderBy('year', 'DESC')->pluck('year', 'year')->toArray();
        $tahun_iuran = Iuran::selectRaw('DISTINCT year(tanggal) year')->orderBy('year', 'DESC')->pluck('year', 'year')->toArray();

        $tahun = array_unique(array_merge($tahun_pemasukan, $tahun_pengeluaran, $tahun_iuran));
        asort($tahun);
        $data = [
            'tahun' => $tahun
        ];

        return view('module.chart.index', $data);
    }

    public function generateChart(Request $request)
    {
        $year = isset($request->year) && $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = ['January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $pemasukan = Pemasukan::selectRaw('year(tanggal) year, monthname(tanggal) month, sum(nominal) data')
                ->whereYear('tanggal', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $pengeluaran = Pengeluaran::selectRaw('year(tanggal) year, monthname(tanggal) month, sum(nominal) data')
                ->whereYear('tanggal', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $iuran = Iuran::selectRaw('year(tanggal) year, monthname(tanggal) month, sum(nominal) data')
                ->whereYear('tanggal', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $data = [
            'pemasukan' => [],
            'pengeluaran' => [],
            'iuran' => [],
        ];

        $key_bulan = 1;
        $key_array = 0;

        foreach($months as $key => $month){
            $key = array_search($month, array_column($pemasukan, 'month'));
            $data_pemasukan = $key === false ? 0 : $pemasukan[$key]['data'];

            $key = array_search($month, array_column($iuran, 'month'));
            $data_iuran = $key === false ? 0 : $iuran[$key]['data'];

            $key = array_search($month, array_column($pengeluaran, 'month'));
            $data_pengeluaran = $key === false ? 0 : $pengeluaran[$key]['data'];

            array_push($data['pemasukan'], $data_pemasukan);
            array_push($data['pengeluaran'], $data_pengeluaran);
            array_push($data['iuran'], $data_iuran);

            // $data['pemasukan'][$key_array] = [
            //     'month_id' => $key_bulan,
            //     'month_name' => $month,
            //     'total_pemasukan' => $data_pemasukan,
            //     'total_pengeluaran' => $data_pengeluaran,
            //     'total_iuran' => $data_iuran,
            // ];

            $key_bulan++;
            $key_array++;
        }

        return response([
            'code' => 1,
            'data' => $data
        ]);
    }
}

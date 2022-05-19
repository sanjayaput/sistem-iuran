<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengeluaran;
use DB;

class ChartController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT a.*, b.total_pengeluaran, c.total_iuran FROM vpemasukan AS a LEFT JOIN vpengeluaran AS b ON b.month_id = a.month_id LEFT JOIN viuran c ON c.month_id = a.month_id");
        return view('module.chart.index', compact('data'));
    }
}

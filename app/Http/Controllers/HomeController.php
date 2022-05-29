<?php

namespace App\Http\Controllers;

use App\ProfilDesa;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/chart');
        $profil_desa = ProfilDesa::first();
        
        $data = [
            'profil_desa' => $profil_desa
        ];                  

        return view('home', $data);
    }
}

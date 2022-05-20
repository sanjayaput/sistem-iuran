<?php

namespace App\Http\Controllers;

use App\ProfilDesa;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function edit()
    {
        $profil_desa = ProfilDesa::first();
        $data = [
            'profil_desa' => $profil_desa
        ];

        return view('module.profil-desa.edit', $data);
    }

    public function updateOrCreate(Request $request)
    {
        // dd($request->all());
        try{
            $profil_desa = ProfilDesa::first();
            if(!$profil_desa){
                $profil_desa = new ProfilDesa();
                $profil_desa->konten = $request->konten;
                $profil_desa->save();
            }else{
                $profil_desa->konten = $request->konten;
                $profil_desa->save();
            }
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('profil-desa')
        ->with('success','Profil desa berhasil diubah...');
    }
}

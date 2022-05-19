<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Iuran;
use App\User;
use DB;
use PDF;

class IuranController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();

         $this->middleware('permission:iuran-list');
         $this->middleware('permission:iuran-create', ['only' => ['create','store']]);
         $this->middleware('permission:iuran-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:iuran-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $anggota = User::role('anggota')->get();
        return view('module.iuran.index', compact('anggota'));
    }

    public function api_iuran(Request $request)
    {
        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT a.*, b.`name` AS anggota FROM iurans a LEFT JOIN users b ON b.id=a.anggota_id";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE a.tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        $data = DB::select($query);
         return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($data) {
                $user = Auth::user();
                $btn = '';

                if ($user->can('iuran-edit')) {
                    $btn = '<a href="#" id="'. $data->id .'" class="badge badge-success badge-icon mr-2"><i class="mi-mode-edit"></i></a>';
                }
                if ($user->can('iuran-delete')) {
                    $btn = $btn.'<a href="#"  id="'. $data->id .'" class="badge badge-danger badge-icon"><i class="mi-delete-forever"></i></a>';
                }
                
                return $btn;

              })
              ->addColumn('status', function($iuran){
                if($iuran->status == 1)
                return '<span class="badge badge-primary">Sudah Bayar</span>';
                else return '<span class="badge badge-secondary">Belum Bayar</span>';
              })
              ->addColumn('anggota', function($iuran){

                return $iuran->anggota;
              })
              ->addColumn('jenis_iuran', function($iuran){

                return $iuran->jenis_iuran;
              })
              ->rawColumns(['action', 'status', 'nominal', 'anggota', 'jenis iuran'])
              ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal'          => 'required|string',
            'nominal'          => 'required|string',
            'status'           => 'required|string',
            'jenis_iuran'      => 'required|string',
            'anggota_id'       => 'required|string',
           
        ]);

        $save = Iuran::create([
            'tanggal'           => $request->input('tanggal'), 
            'nominal'           => $request->input('nominal'),
            'status'            => $request->input('status'),
            'jenis_iuran'       => $request->input('jenis_iuran'),
            'anggota_id'        => $request->input('anggota_id'),
            'user_id'           => Auth::user()->id
        ]);

        if ($save) {
            return respondWithMessage("Data berhasil disimpan....", true, 200);
        }else{
            return respondWithMessage("Data gagal disimpan....", false, 409);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Iuran::find($id);
        
        return respondWithData(true, 200, 'Data Iuran', $data);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [ 
            'tanggal'          => 'required|string',
            'nominal'          => 'required|string',
            'status'           => 'required|string',
            'jenis_iuran'      => 'required|string',
            'anggota_id'       => 'required|string',
        ]);
      
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }

        $data = Iuran::find($id);
        $data->tanggal          = $request->input('tanggal');
        $data->nominal          = $request->input('nominal');
        $data->status           = $request->input('status');
        $data->jenis_iuran      = $request->input('jenis_iuran');
        $data->anggota_id       = $request->input('anggota_id');
        $data->save();

        if ($data) {
            return respondWithMessage("Data berhasil disimpan....", true, 200);
        }else{
            return respondWithMessage("Data gagal disimpan....", false, 409);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("iurans")->where('id',$id)->delete();
        return redirect()->route('iuran')
                        ->with('success','Data berhasil dihapus...');
    }

    public function report_pdf(Request $request)
    {

        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT a.*, b.`name` AS anggota FROM iurans a LEFT JOIN users b ON b.id=a.anggota_id";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        $data = DB::select($query);
    
        $pdf = PDF::loadview('module.iuran.pdf',['iuran'=>$data]);
        return $pdf->stream();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Pemasukan;
use DB;
use PDF;

class PemasukanController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();

         $this->middleware('permission:pemasukan-list');
         $this->middleware('permission:pemasukan-create', ['only' => ['create','store']]);
         $this->middleware('permission:pemasukan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pemasukan-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('module.pemasukan.index');
    }

    public function api_pemasukan(Request $request)
    {
        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT * FROM pemasukans";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        $data = DB::select($query);
         return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($data) {
                $user = Auth::user();
                $btn = '';

                if ($user->can('pemasukan-edit')) {
                    $btn = '<a href="#" id="'. $data->id .'" class="badge badge-success badge-icon mr-2"><i class="mi-mode-edit"></i></a>';
                }
                if ($user->can('pemasukan-delete')) {
                    $btn = $btn.'<a href="#"  id="'. $data->id .'" class="badge badge-danger badge-icon"><i class="mi-delete-forever"></i></a>';
                }
                
                return $btn;

              })
              ->addColumn('status', function($pemasukan){
                if($pemasukan->status == 1)
                return '<span class="badge badge-primary">Sudah Disetujui</span>';
                else return '<span class="badge badge-secondary">Belum Disetujui</span>';
              })
              ->addColumn('nominal', function($pemasukan){
                return format_rupiah($pemasukan->nominal);
              })
              ->rawColumns(['action', 'status', 'nominal'])
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
        $field = [
            'tanggal'          => 'required|string',
            'nominal'          => 'required|string',
            'jenis_pemasukan'  => 'required|string',
            'keterangan'       => 'required|string',
        ];

        if(Auth::user()->hasRole('kades')){
            $field += ['status' => 'required|string'];
        }

        $this->validate($request, $field);


        $save = Pemasukan::create([
            'tanggal'           => $request->input('tanggal'), 
            'nominal'           => $request->input('nominal'),
            'status'            => Auth::user()->hasRole('kades') ? $request->input('status') : 0,
            'jenis_pemasukan'   => $request->input('jenis_pemasukan'),
            'keterangan'        => $request->input('keterangan'),
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
        $data = Pemasukan::find($id);
        
        return respondWithData(true, 200, 'Data Pemasukan', $data);
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

        $field = [ 
            'tanggal'          => 'required|string',
            'nominal'          => 'required|string',
            'jenis_pemasukan'  => 'required|string',
            'keterangan'       => 'required|string',
        ];

        if(Auth::user()->hasRole('kades')){
            $field += ['status' => 'required|string'];
        }

        $validator = Validator::make($request->all(), $field);
      
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }

        $data = Pemasukan::find($id);
        $data->tanggal          = $request->input('tanggal');
        $data->nominal          = $request->input('nominal');
        
        if(Auth::user()->hasRole('kades')){
            $data->status           = $request->input('status');
        }

        $data->jenis_pemasukan  = $request->input('jenis_pemasukan');
        $data->keterangan       = $request->input('keterangan');
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
        DB::table("pemasukans")->where('id',$id)->delete();
        return redirect()->route('pemasukan')
                        ->with('success','Pemasukan berhasil dihapus...');
    }

    public function report_pdf(Request $request)
    {

        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT * FROM pemasukans";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        $data = DB::select($query);
    
        $pdf = PDF::loadview('module.pemasukan.pdf',['pemasukan'=>$data]);
        return $pdf->stream();
    }

}

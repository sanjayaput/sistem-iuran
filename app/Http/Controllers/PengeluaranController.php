<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Pengeluaran;
use DB;
use PDF;
use File;

class PengeluaranController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();

         $this->middleware('permission:pengeluaran-list');
         $this->middleware('permission:pengeluaran-create', ['only' => ['create','store']]);
         $this->middleware('permission:pengeluaran-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pengeluaran-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('module.pengeluaran.index');
    }

    public function api_pengeluaran(Request $request)
    {
        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT * FROM pengeluarans";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        $data = DB::select($query);
         return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($data) {
                $user = Auth::user();
                $btn = '';

                if ($user->can('pengeluaran-edit')) {
                    $btn = '<a href="#" id="'. $data->id .'" class="badge badge-success badge-icon mr-2"><i class="mi-mode-edit"></i></a>';
                }
                if ($user->can('pengeluaran-delete')) {
                    $btn = $btn.'<a href="#"  id="'. $data->id .'" class="badge badge-danger badge-icon"><i class="mi-delete-forever"></i></a>';
                }
                
                return $btn;

              })
              ->addColumn('status', function($pengeluaran){
                if($pengeluaran->status == 1)
                return '<span class="badge badge-primary">Sudah Disetujui</span>';
                else return '<span class="badge badge-secondary">Belum Disetujui</span>';
              })
              ->addColumn('nominal', function($pengeluaran){
                return format_rupiah($pengeluaran->nominal);
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
            'catatan'          => 'required|string',
            'bukti'            => 'image|mimes:jpeg,png,jpg|max:2048'
        ];

        if(Auth::user()->hasRole('kades')){
            $field += ['status' => 'required|string'];
        }

        $this->validate($request, $field);

        // attribute photo
        $filename = '';
        if ($request->hasFile('bukti')) {
            $filename = Str::random(10) . '.jpg';
            $file = $request->file('bukti');
            $file = $file->move(('upload/images/bukti'), $filename);
        }

        $save = Pengeluaran::create([
            'tanggal'           => $request->input('tanggal'), 
            'nominal'           => $request->input('nominal'),
            'status'            => Auth::user()->hasRole('kades') ? $request->input('status') : 0,
            'catatan'           => $request->input('catatan'),
            'bukti'             => $filename,
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
        $data = Pengeluaran::find($id);
        
        return respondWithData(true, 200, 'Data Pengeluaran', $data);
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
            'catatan'          => 'required|string',
            // 'bukti'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];

        if(Auth::user()->hasRole('kades')){
            $field += ['status' => 'required|string'];
        }

        $validator = Validator::make($request->all(), $field);
      
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }

        $data = Pengeluaran::find($id);

        // attribute photo
        $filename = $data->bukti;
        if ($request->hasFile('bukti')) {
            $img_bukti = base_path("upload/images/bukti/{$data->bukti}");
            if (File::exists($img_bukti)) {
                unlink($img_bukti);
            }

            $filename = Str::random(10) . '.jpg';
            $file = $request->file('bukti');
            $file = $file->move(('upload/images/bukti'), $filename);
        }

        $data->tanggal          = $request->input('tanggal');
        $data->nominal          = $request->input('nominal');
        
        if(Auth::user()->hasRole('kades')){
            $data->status           = $request->input('status');
        }

        $data->catatan          = $request->input('catatan');
        $data->bukti            = $filename;
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
        $data = Pengeluaran::find($id);
        $dataImg = "upload/images/bukti/{$data->bukti}";
        if (File::exists($dataImg)) {
            unlink($dataImg);
            $data->delete();
        }
            
        return redirect()->route('pengeluaran')
                        ->with('success','Data berhasil dihapus...');

    }

    public function report_pdf(Request $request)
    {

        $date_from      = $request->start_date;
        $date_to        = $request->end_date;

        $query = "SELECT * FROM pengeluarans";

        if($request->has('start_date') && $date_from!=''){
            $query = $query." WHERE tanggal BETWEEN '$date_from' AND '$date_to'";
        }

        
        $data = DB::select($query);
        // return view('module.pengeluaran.pdf',['pengeluaran'=>$data]);
    
        $pdf = PDF::loadview('module.pengeluaran.pdf',['pengeluaran'=>$data]);
        return $pdf->stream();
    }

}

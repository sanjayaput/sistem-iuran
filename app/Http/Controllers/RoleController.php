<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::get();
        return view('module.roles.index',compact('permissions'));
    }

    public function rolesData()
    {
        $roles = Role::all();
         return Datatables::of($roles)
              ->addIndexColumn()
              ->addColumn('action', function ($roles) {
                $user = Auth::user();
                $btn = '';

                if ($user->can('role-edit')) {
                    $btn = '<a href="#" id="'. $roles->id .'" class="badge badge-success badge-icon mr-2"><i class="mi-mode-edit"></i></a>';
                }
                if ($user->can('role-delete')) {
                    $btn = $btn.'<a href="#"  id="'. $roles->id .'" class="badge badge-danger badge-icon"><i class="mi-delete-forever"></i></a>';
                }
                
                return $btn;

              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('module.roles.create',compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $success = $role->syncPermissions($request->input('permission'));

        if ($success) {
            return respondWithMessage("Data berhasil disimpan....", true, 200);
        }else{
            return respondWithMessage("Data gagal disimpan....", false, 409);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('module.roles.show',compact('role','rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $data = array('role'=>$role,'permission'=>$rolePermissions);
        return respondWithData(true, 200, 'Role data', $data);
        //return view('module.roles.edit',compact('role','permission','rolePermissions'));
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
            'name'       => 'required',
            'permission' => 'required',
        ]);
      
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permission = $arr=explode(",",$request->input('permission'));
        $success = $role->syncPermissions($permission);

        if ($success) {
            return respondWithMessage("Data berhasil disimpan....", true, 200);
        }else{
            return respondWithMessage("Data gagal disimpan....", false, 409);
        }


        // return redirect()->route('roles.index')
        //                 ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles')
                        ->with('success','Role deleted successfully');
    }
}
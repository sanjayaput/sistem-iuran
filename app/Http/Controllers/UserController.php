<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use DB;
use File;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();

         $this->middleware('permission:user-list', ['only' => ['index','userData']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('module.users.index');
    }

    public function userData()
    {
        $users = User::with('roles')->orderBy('name', 'asc');
         return Datatables::of($users)
              ->addIndexColumn()
              ->addColumn('action', function ($users) {
                $url  = url('/');
                $user = Auth::user();
                $btn = '';

                if ($user->can('user-edit')) {
                    $btn = '<a href="'.$url.'/users/edit/'. $users->id .'" class="badge badge-success badge-icon"><i class="mi-mode-edit"></i></a>';
                }
                if ($user->can('user-delete')) {
                    $btn = $btn.'<a href="#"  id="'. $users->id .'" class="badge badge-danger badge-icon ml-2"><i class="mi-delete-forever"></i></a>';
                }
                
                return $btn;
                })
              ->addColumn('active', function(User $user){
                if($user->active == 1)
                return '<span class="badge badge-primary">Aktif</span>';
                else return '<span class="badge badge-secondary">Non Aktif</span>';
              })
              ->addColumn('roles',function(User $user){
                 $roles = $user->roles->pluck('name')->toArray();
                 $badge = '';
                foreach ($roles as $role) {
                    $badge .= '<span class="badge badge-light badge-striped badge-striped-left border-left-info mr-2">'.($role == 'kades' ? 'bendesa' : $role).'</span>';
                }
                 return $badge;
              })
              ->rawColumns(['action', 'active', 'roles'])
              ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('module.users.create',compact('roles'));
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
            'name'          => 'required',
            // 'email'         => 'required|email|unique:users,email',
            'username'      => 'required|unique:users,username',
            'password'      => 'required|same:confirm_password',
            'jenis_kelamin' => 'required|string',
            'roles'         => 'required'
        ]);


        // attribute photo
        $filename = 'avatar.png';
        if ($request->hasFile('photo')) {
            $filename = Str::random(5) . $request->username . '.jpg';
            $file = $request->file('photo');
            $file->move(('upload/images/users'), $filename);
            $input['foto'] = $filename;
        }


        $user = User::create([
            'name'          => ucwords(strtolower($request->name)),
            // 'email'         => $request->email,
            'username'         => $request->username,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => ucwords(strtolower($request->alamat)),
            'foto'          => $filename,
            // 'email'         => $request->email,
            'password'      => Hash::make($request->input('password')),
            'api_token'     => Str::random(60),
            'active'        => '1',
        ]);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users')
                        ->with('success','Pengguna berhasil dibuat...');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('module.users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name'          => 'required',
            'username'         => 'required|unique:users,username,'.$id,
            // 'email'         => 'required|email|unique:users,email,'.$id,
            'password'      => 'same:confirm_password',
            //'roles'         => 'required',
            'jenis_kelamin' => 'required|string',
            //'active'        => 'required'
        ]);
        


        $user = User::find($id);

         // attribute photo
         $filename = $user->foto;
         if ($request->hasFile('photo')) {
             $user_foto = "upload/images/users/{$user->foto}";
             if (File::exists($user_foto) && $user->foto!='avatar.png' && $user->foto!=NULL) {
                 unlink($user_foto);
             }
             $filename = Str::random(5) . $request->username . '.jpg';
             $file = $request->file('photo');
             $file = $file->move(('upload/images/users'), $filename);
         }

            // password
            $password = $request->password != '' ? app('hash')->make($request->password):$user->password;
            $active   = $request->active != '' ? $request->active : '1';

            // update
            $update = $user->update([
                'name'         => $request->name,
                'username'        => $request->username,
                // 'email'        => $request->email,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'alamat'       => $request->alamat,
                'foto'         => $filename,
                'password'     => $password,
                'active'       => $active
            ]);

        if($request->input('roles')!=''){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('users')
                         ->with('success','Data pengguna berhasil di perbaharui....');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users')
                        ->with('success','Pengguna berhasil dihapus...');
    }
}
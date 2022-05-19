<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
          // check if table users is empty
        if(DB::table('permissions')->get()->count() == 0){

            DB::table('permissions')->insert([

                [
                    'guard_name'      => 'web',
                    'name'            => 'role-list',
                    'display_name'    => 'lihat level',
                    'module'          => 'Level',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'role-create',
                    'display_name'    => 'tambah level',
                    'module'          => 'Level',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'role-edit',
                    'display_name'    => 'edit level',
                    'module'          => 'Level',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'role-delete',
                    'display_name'    => 'hapus level',
                    'module'          => 'Level',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'user-list',
                    'display_name'    => 'lihat pengguna',
                    'module'          => 'Pengguna',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'user-create',
                    'display_name'    => 'tambah pengguna',
                    'module'          => 'Pengguna',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'user-edit',
                    'display_name'    => 'edit level',
                    'module'          => 'Pengguna',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'user-delete',
                    'display_name'    => 'hapus level',
                    'module'          => 'Pengguna',
                  ],
                  [
                    'guard_name'      => 'web',
                    'name'            => 'permission-list',
                    'display_name'    => 'lihat akses',
                    'module'          => 'Akses',
                   ],
                   [
                    'guard_name'      => 'web',
                    'name'            => 'permission-create',
                    'display_name'    => 'tambah akses',
                    'module'          => 'Akses',
                   ],
                   [
                    'guard_name'      => 'web',
                    'name'            => 'permission-edit',
                    'display_name'    => 'edit akses',
                    'module'          => 'Akses',
                   ],
                   [
                    'guard_name'      => 'web',
                    'name'            => 'permission-delete',
                    'display_name'    => 'hapus akses',
                    'module'          => 'Akses',
                   ]
            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }


    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $admin->givePermissionTo(Permission::all());

        $user = Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $p_edit    = Permission::create(['name'=>'edit_product']);
        $p_delete  = Permission::create(['name'=>'delete_product']);
        $p_create  = Permission::create(['name'=>'create_product']);
        $p_promote = Permission::create(['name'=>'promote_user']);

        $superAdmin = Role::create([
            'name' => 'super_admin',
            'is_super_admin' => true
        ]);

        $admin = Role::create(['name'=>'admin']);
        $admin->permissions()->attach([
            $p_edit->id,
            $p_delete->id,
            $p_create->id,
            $p_promote->id
        ]);

        $seller = Role::create(['name'=>'seller']);
        $seller->permissions()->attach([
            $p_edit->id,
            $p_create->id
        ]);

        $userRole = Role::create(['name'=>'user']);
    }
}


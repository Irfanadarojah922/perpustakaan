<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        //create permission
        Permission::create(['name' => 'dashboard_index']);
        Permission::create(['name' => 'dashboard_store']);
        Permission::create(['name' => 'dashboard_update']);
        Permission::create(['name' => 'dashboard_destroy']);

        //create roles
        $SuperAdminRole = Role::create(["name" => 'Super Admin']);


        //Assign Role
        $SuperAdminRole->givePermissionTo(Permission::all());

        //Assign User to Role
        $superadmin = User::where('email', 'superadmin@gmail.com')->first();
        $superadmin->assignRole('Super Admin');
    }
}

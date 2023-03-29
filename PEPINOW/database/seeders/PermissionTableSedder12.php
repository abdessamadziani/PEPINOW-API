<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions

        Permission::create(['name' => 'view categorie']);
        Permission::create(['name' => 'create categorie']);
        Permission::create(['name' => 'edit categorie']);
        Permission::create(['name' => 'delete categorie']);

        Permission::create(['name' => 'view plants']);
        Permission::create(['name' => 'create plants']);
        Permission::create(['name' => 'edit plants']);
        Permission::create(['name' => 'delete plants']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $vendeurRole = Role::create(['name' => 'vendeur']);
        $userRole = Role::create(['name' => 'user']);

        // Assign Permissions to Roles
        $adminRole->syncPermissions(Permission::all());
        $vendeurRole->syncPermissions([
            'view categorie', 'create categorie', 'edit categorie', 'delete categorie',
            'view plants', 'create plants', 'edit plants', 'delete plants',
        ]);
        $userRole->syncPermissions(['view plants',]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit checklists']);
        Permission::create(['name' => 'view users info']);
        Permission::create(['name' => 'view users checklists']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'set permissions']);
        Permission::create(['name' => 'ban users']);
        Permission::create(['name' => 'set users checklist count']);



        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('edit checklists');


        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(['ban users','view users info','view users checklists','edit checklists']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['ban users','view users info','view users checklists','edit checklists','set users checklist count']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}

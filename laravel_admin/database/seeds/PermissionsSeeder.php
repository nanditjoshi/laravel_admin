<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Store permissions
        $permissions = config('permissions');
        $permissionModels = [];
        foreach($permissions as $name => $displayName) {
            $permission = Permission::firstOrNew([
                'name' => $name
            ]);
            $permission->display_name = $displayName;
            $permission->save();
            $permissionModels[$name] = $permission;
        }

        $roles = config('roles');
        foreach($roles as $id => $roleConfig) {
            $role = Role::findOrNew($id);
            $role->fill([
                'name' => $roleConfig['role'],
                'is_system_role' => true
            ]);
            $role->save();
            $rolePermissionIds = [];
            foreach($roleConfig['permissions'] as $role_permission) {
                $rolePermissionIds[] = $permissionModels[$role_permission]->id;
            }
            $role->permissions()->sync($rolePermissionIds);
        }
        $roleIds = array_keys($roles);
        Role::where('is_system_role', '=', 1)->whereNotIn('id', $roleIds)->delete();
    }
}

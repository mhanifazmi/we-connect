<?php

namespace Database\Seeders;

use App\Models\Permission as ModelsPermission;
use App\Models\Role as ModelsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_permissions = [];

        $custom_permissions = ModelsPermission::customPermissions();

        $perms = ModelsPermission::subPermissions();

        $models = ModelsPermission::permissions();

        foreach ($models as $model) {
            if (array_key_exists($model, $custom_permissions)) {
                $cust = $custom_permissions[$model];
            } else {
                $cust = $perms;
            }

            $all_permissions[] = [
                'name' => $model,
                'permissions' => $cust
            ];
            $cust = $perms;
        }

        $guard_name = 'web';

        foreach ($all_permissions as $permission) {
            foreach ($permission['permissions'] as $p) {
                $name = $p . ' ' . $permission['name'];
                Permission::firstOrCreate([
                    'name' => $name,
                    'guard_name' => $guard_name
                ]);
            }
        }

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));

        //superadmin starts
        $super_admin_permissions =
            [
                [
                    'name' => 'Dashboard',
                ],
                [
                    'name' => 'Users',
                ],
                [
                    'name' => 'Roles',
                ],
                [
                    'name' => 'Links',
                ],
            ];

        $sa_perms = [];

        foreach ($super_admin_permissions as $perm) {
            if (array_key_exists('permissions', $perm)) {
                foreach ($perm['permissions'] as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $sa_perms[] = $name;
                }
            } else {
                foreach ($perms as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $sa_perms[] = $name;
                }
            }
        }

        $superadmin_role = Role::find(ModelsRole::IS_SUPERADMIN);

        $p_all = Permission::all();
        if (isset($p_all) && !empty($p_all) && count($p_all) > 0) {
            foreach ($p_all as $p) {
                $superadmin_role->revokePermissionTo($p);
            }
        }

        $superadmin_role->givePermissionTo($sa_perms);

        $superadmins = User::where('role_id', ModelsRole::IS_SUPERADMIN)->get();

        foreach ($superadmins as $admin) {
            $admin->assignRole($superadmin_role);
        }

        //superadmin ends

        //admin starts
        $admin_permissions =
            [
                [
                    'name' => 'Dashboard',
                ],
                [
                    'name' => 'Users',
                ],
                [
                    'name' => 'Links',
                ],
            ];

        $a_perms = [];

        foreach ($admin_permissions as $perm) {
            if (array_key_exists('permissions', $perm)) {
                foreach ($perm['permissions'] as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $a_perms[] = $name;
                }
            } else {
                foreach ($perms as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $a_perms[] = $name;
                }
            }
        }

        $admin_role = Role::find(ModelsRole::IS_ADMIN);

        $p_all = Permission::all();
        if (isset($p_all) && !empty($p_all) && count($p_all) > 0) {
            foreach ($p_all as $p) {
                $admin_role->revokePermissionTo($p);
            }
        }

        $admin_role->givePermissionTo($a_perms);

        $admins = User::where('role_id', ModelsRole::IS_ADMIN)->get();

        foreach ($admins as $admin) {
            $admin->assignRole($admin_role);
        }
        //admin ends

        //user starts
        $user_permissions =
            [
                [
                    'name' => 'Dashboard',
                ],
                [
                    'name' => 'Users',
                ],
                [
                    'name' => 'Links',
                ],
            ];

        $u_perms = [];

        foreach ($user_permissions as $perm) {
            if (array_key_exists('permissions', $perm)) {
                foreach ($perm['permissions'] as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $u_perms[] = $name;
                }
            } else {
                foreach ($perms as $p) {
                    $name = $p . ' ' . $perm['name'];
                    $u_perms[] = $name;
                }
            }
        }

        $user_role = Role::find(ModelsRole::IS_USER);

        $p_all = Permission::all();
        if (isset($p_all) && !empty($p_all) && count($p_all) > 0) {
            foreach ($p_all as $p) {
                $user_role->revokePermissionTo($p);
            }
        }

        $user_role->givePermissionTo($u_perms);

        $users = User::where('role_id', ModelsRole::IS_USER)->get();

        foreach ($users as $user) {
            $user->assignRole($user_role);
        }
        //user ends
    }
}

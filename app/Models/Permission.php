<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends BaseModel
{
    use HasFactory;

    public static function permissions()
    {
        $roles = Role::all()->pluck('name')->toArray();

        $permissions = [
            'Dashboard',
            'Users',
            'Roles',
            'Links',
        ];

        $permissions = array_merge($permissions, $roles);

        return $permissions;
    }

    public static function subPermissions()
    {
        return [
            'Manage',
            'View',
            'Create',
            'Edit',
            'Delete'
        ];
    }

    public static function customPermissions()
    {
        return [];
    }
}

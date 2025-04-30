<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function index($count = 10)
    {
        $permissions = Permission::paginate($count);
        return $permissions;
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\PermissionGroup;

class GeneratePermissions extends Command
{
    protected $signature = 'permissions:generate';
    protected $description = 'Generate permission groups and permissions from route names';

    public function handle()
    {
        $routes = Route::getRoutes();
        $groupedPermissions = [];

        foreach ($routes as $route) {
            if ($name = $route->getName()) {
                $parts = explode('.', $name);
                if (count($parts) && !in_array($parts[0], ['storage', 'livewire'])) {
                    $groupName = ucfirst($parts[0]);
                    $permissionName = $name;

                    $groupedPermissions[$groupName][] = $permissionName;
                }
            }
        }

        foreach ($groupedPermissions as $groupName => $permissions) {
            $group = PermissionGroup::firstOrCreate(['name' => $groupName]);

            foreach ($permissions as $permissionName) {
                Permission::firstOrCreate([
                    'permission_group_id' => $group->id,
                    'path' => $permissionName,
                    'name' => $permissionName,
                ]);
            }
        }

        $this->info('Permissions and groups generated successfully!');
    }
}

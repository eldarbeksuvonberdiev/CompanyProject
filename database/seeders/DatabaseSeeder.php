<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'accountant']);
        $role3 = Role::create(['name' => 'cashier']);
        $role4 = Role::create(['name' => 'producer']);
        $role5 = Role::create(['name' => 'hr']);
        $role6 = Role::create(['name' => 'logistic_manager']);
        $role7 = Role::create(['name' => 'storage_manager']);
        $role8 = Role::create(['name' => 'sale_manager']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456)
        ]);

        $user->roles()->attach($role1->id);
        $roles = Role::all();
        for ($i = 1; $i <= 7; $i++) {
            $user = User::create([
                'name' => $roles[$i]->name,
                'email' => $roles[$i]->name . '@gmail.com',
                'password' => Hash::make(123456)
            ]);
            $user->roles()->attach($roles[$i]->id);
        }

        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $key = $route->getName();


            if ($key && $key !== 'storage.local') {
                $key1 = $key;
                $groupName = explode('.', $key1)[0];
                $group = PermissionGroup::firstOrCreate(['name' => $groupName]);
                $name = ucfirst(str_replace('.', '-', $key));
                Permission::create([
                    'key' => $key,
                    'name' => $name,
                    'permission_group_id' => $group->id
                ]);
            }
        }
        $permissions = Permission::pluck('id')->toArray();

        $role1->permissions()->attach($permissions);
        $role2->permissions()->attach($permissions);
        $role3->permissions()->attach($permissions);
        $role4->permissions()->attach($permissions);
        $role5->permissions()->attach($permissions);
        $role6->permissions()->attach($permissions);
        $role7->permissions()->attach($permissions);
    }
}

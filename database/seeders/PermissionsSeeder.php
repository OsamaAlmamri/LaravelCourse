<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            "users" => ['access', 'create', 'update', 'delete'],
            "roles" => ['access', 'create', 'update', 'delete'],
            "categories" => ['access', 'create', 'update', 'delete'],
            "products" => ['access', 'create', 'update', 'delete'],
            "brands" => ['access', 'create', 'update', 'delete'],
            "orders" => ['access', 'delete'],
            "settings" => ['access', 'update'],
        ]);

        $collection->each(function ($items, $key) {
            foreach ($items as $item)
                Permission::UpdateOrcreate(['name' => $item . '-' . $key], ['guard_name' => 'web', 'group' => $key]);

        });


        // Create a Super-Admin Role and assign all permissions to it
        $role = Role::updateOrCreate(["name" => "admin"], ['guard_name' => 'web', "name" => "admin"])
            ->givePermissionTo(Permission::all());
        Role::updateOrCreate(["name" => "user"], ['guard_name' => 'web', "name" => "user"]);

        $user = User::whereEmail('yemencoder@gmail.com')->first(); // enter your email here
        $user->assignRole('admin');


    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        Permission::create(['name' => 'Users.*']);
        Permission::create(['name' => 'Users.viewAny']);
        Permission::create(['name' => 'Users.view']);
        Permission::create(['name' => 'Users.create']);
        Permission::create(['name' => 'Users.update']);
        Permission::create(['name' => 'Users.delete']);

        Permission::create(['name' => 'Roles.*']);
        Permission::create(['name' => 'Roles.viewAny']);
        Permission::create(['name' => 'Roles.view']);
        Permission::create(['name' => 'Roles.create']);
        Permission::create(['name' => 'Roles.update']);
        Permission::create(['name' => 'Roles.delete']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};

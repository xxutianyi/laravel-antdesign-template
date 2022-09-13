<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $root = User::create([
            'id' => Str::uuid(),
            'name' => 'Administrator',
            'mobile' => 'administrator',
            'password' => Hash::make(config('utils.default.password.root'))
        ]);

        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        Role::create(['name' => 'root']);
        $root->assignRole('root');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

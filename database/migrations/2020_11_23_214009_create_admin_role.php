<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

/**
 * Creates admin role.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class CreateAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->save();

        $admin = new User(
            [
                'name' => 'Admin Istrator',
                'email' => 'admin@foo.bar',
                'password' => Hash::make('123'),
            ]
        );

        $admin->markEmailAsVerified();
        $admin->assignRole('admin');

        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::where('name', 'admin')->delete();
    }
}

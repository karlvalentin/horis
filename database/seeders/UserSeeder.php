<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}

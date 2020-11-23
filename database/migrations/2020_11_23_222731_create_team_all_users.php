<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates team "all users" and assigns all users to it.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class CreateTeamAllUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $allUsers = new \App\Models\Team(
            [
                'name' => 'all users',
                'personal_team' => false,
            ]
        );

        /** @var User $admin */
        $admin = User::firstOrFail();

        $allUsers->owner()->associate($admin);

        $allUsers->save();

        $admin->current_team_id = $allUsers->id;

        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Team::where('name', 'allUsers')->delete();
    }
}

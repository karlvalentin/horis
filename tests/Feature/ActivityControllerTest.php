<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    /**
     * Tests deleting an activity the happy path.
     *
     * @return void
     */
    public function testDeleteActivityTheHappyPath()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $activity = new Activity();

        $activity->name = Str::random();
        $activity->save();

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'activities.delete',
                    [
                        'activity' => $activity->id,
                    ]
                )
            );

        $response->assertStatus(302);
        $response->assertLocation(route('activities'));

        $this->expectException(ModelNotFoundException::class);

        $activity = Activity::findOrFail($activity->id);
    }

    /**
     * Tests deleting a not deletable activity.
     *
     * @return void
     */
    public function testDeleteNotDeletableActivity()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $activity = new Activity();

        $activity->name = Str::random();
        $activity->save();

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_ACTIVITY_ID => $activity->id,
                ]
            );
        $entry->save();

        $activity->refresh();

        $this->assertEquals(false, $activity->isDeletable());

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'activities.delete',
                    [
                        'activity' => $activity->id,
                    ]
                )
            );

        $response->assertStatus(302);

        $activity = Activity::findOrFail($activity->id);

        $this->assertInstanceOf(Activity::class, $activity);
    }
}

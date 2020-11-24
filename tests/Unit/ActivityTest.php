<?php

namespace Tests\Unit;

use App\Exceptions\NotDeletableException;
use App\Models\Activity;
use App\Models\Entry;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Test activity model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class ActivityTest extends TestCase
{
    /**
     * Tests that activity is only deletable when not having related entries.
     */
    public function testDeletableTest()
    {
        $activity = new Activity();

        $activity->name = Str::random();
        $activity->save();

        $this->assertEquals(true, $activity->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_ACTIVITY_ID => $activity->id,
                ]
            );
        $entry->save();

        $activity->refresh();

        $this->assertEquals(false, $activity->isDeletable());
    }

    /**
     * Tests that deleting a not deletable activity throws ans exception.
     *
     * @throws \Exception
     */
    public function testDeletingNotDeletableThrowsException()
    {
        $activity = new Activity();

        $activity->name = Str::random();
        $activity->save();

        $this->assertEquals(true, $activity->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_ACTIVITY_ID => $activity->id,
                ]
            );
        $entry->save();

        $activity->refresh();

        $this->expectException(NotDeletableException::class);
        $this->expectExceptionMessage('Activity is not deletable.');

        $activity->delete();
    }
}

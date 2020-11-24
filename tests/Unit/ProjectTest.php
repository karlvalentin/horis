<?php

namespace Tests\Unit;

use App\Exceptions\NotDeletableException;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Entry;
use App\Models\Project;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Test project model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class ProjectTest extends TestCase
{
    /**
     * Tests that a project is only deletable when not having related entries.
     */
    public function testDeletableTest()
    {
        $project = new Project();

        $project->name = Str::random();
        $project->active = true;
        $project->save();

        $this->assertEquals(true, $project->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_PROJECT_ID => $project->id,
                ]
            );
        $entry->save();

        $project->refresh();

        $this->assertEquals(false, $project->isDeletable());
    }

    /**
     * Tests that deleting a not deletable customer throws ans exception.
     *
     * @throws \Exception
     */
    public function testDeletingNotDeletableThrowsException()
    {
        $project = new Project();

        $project->name = Str::random();
        $project->active = true;
        $project->save();

        $this->assertEquals(true, $project->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_PROJECT_ID => $project->id,
                ]
            );
        $entry->save();

        $project->refresh();

        $this->expectException(NotDeletableException::class);
        $this->expectExceptionMessage('Project is not deletable.');

        $project->delete();
    }
}

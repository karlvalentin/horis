<?php

namespace Tests\Feature;

use App\Models\Entry;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    /**
     * Tests deleting a project the happy path.
     *
     * @return void
     */
    public function testDeleteProjectTheHappyPath()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $project = new Project();

        $project->name = Str::random();
        $project->active = true;
        $project->save();

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'projects.delete',
                    [
                        'project' => $project->id,
                    ]
                )
            );

        $response->assertStatus(302);
        $response->assertLocation(route('projects'));

        $this->expectException(ModelNotFoundException::class);

        $project = Project::findOrFail($project->id);
    }

    /**
     * Tests deleting a not deletable project.
     *
     * @return void
     */
    public function testDeleteNotDeletableProject()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $project = new Project();

        $project->name = Str::random();
        $project->active = true;
        $project->save();

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_PROJECT_ID => $project->id,
                ]
            );
        $entry->save();

        $project->refresh();

        $this->assertEquals(false, $project->isDeletable());

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'projects.delete',
                    [
                        'project' => $project->id,
                    ]
                )
            );

        $response->assertStatus(302);

        $project = Project::findOrFail($project->id);

        $this->assertInstanceOf(Project::class, $project);
    }
}

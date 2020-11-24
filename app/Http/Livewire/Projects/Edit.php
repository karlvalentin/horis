<?php

namespace App\Http\Livewire\Projects;

use App\Http\Requests\Project\Store;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    /**
     * @var Project
     */
    public $project;

    protected $rules = [
        'project.name' => [
            'string',
//            'unique:App\Models\Project,name',
        ],
        'project.active' => 'boolean',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(Request $request)
    {
        $validatedData = Validator::make(
            $this->project->toArray(),
            [
                'name' => [
                    'string',
                    Rule::unique('projects')->ignore($this->project->id),
                ],
                'active' => 'boolean',
            ]
        )
            ->validated();

        $this->project->fill($validatedData);

        $this->project->save();
    }

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.edit');
    }
}

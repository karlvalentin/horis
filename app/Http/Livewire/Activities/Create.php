<?php

namespace App\Http\Livewire\Activities;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
{
    /**
     * @var Activity
     */
    public $activity;

    /**
     * Validation rules.
     *
     * @var \string[][]
     */
    protected $rules = [
        'activity.name' => [
            'string',
            'unique:App\Models\Activity,name',
        ],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Save activity.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        $validatedData = Validator::make(
            $this->activity->toArray(),
            [
                'name' => [
                    'string',
                    'unique:App\Models\Activity,name',
                ],
            ]
        )
            ->validated();

        $this->activity->fill($validatedData);

        $this->activity->save();

        return redirect()
            ->route(
                'activities.edit',
                [
                    'activity' => $this->activity->id,
                ]
            );
    }

    /**
     * Bind data.
     *
     * @param Activity $activity
     */
    public function mount(Activity $activity)
    {
        $this->activity = $activity;

        $this->activity->name = __('model.activity.new');
    }

    /**
     * Render component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.activities.create');
    }
}

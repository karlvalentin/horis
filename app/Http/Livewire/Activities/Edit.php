<?php

namespace App\Http\Livewire\Activities;

use App\Http\Requests\Project\Store;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
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
        ],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Save customer.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        $validatedData = Validator::make(
            $this->activity->toArray(),
            [
                'name' => [
                    'string',
                    Rule::unique('activities')->ignore($this->activity->id),
                ],
            ]
        )
            ->validated();

        $this->activity->fill($validatedData);

        $this->activity->save();
    }

    /**
     * Bind data.
     *
     * @param Activity $activity
     */
    public function mount(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Render component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.activities.edit');
    }
}

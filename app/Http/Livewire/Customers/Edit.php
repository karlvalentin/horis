<?php

namespace App\Http\Livewire\Customers;

use App\Http\Requests\Project\Store;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    /**
     * @var Customer
     */
    public $customer;

    /**
     * Validation rules.
     *
     * @var \string[][]
     */
    protected $rules = [
        'customer.name' => [
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
            $this->customer->toArray(),
            [
                'name' => [
                    'string',
                    Rule::unique('customers')->ignore($this->customer->id),
                ],
            ]
        )
            ->validated();

        $this->customer->fill($validatedData);

        $this->customer->save();
    }

    /**
     * Bind data.
     *
     * @param Customer $customer
     */
    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Render component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.customers.edit');
    }
}

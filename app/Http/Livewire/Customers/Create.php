<?php

namespace App\Http\Livewire\Customers;

use App\Http\Requests\Project\Store;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
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
            'unique:App\Models\Customer,name',
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        $validatedData = Validator::make(
            $this->customer->toArray(),
            [
                'name' => [
                    'string',
                    'unique:App\Models\Project,name',
                ],
            ]
        )
            ->validated();

        $this->customer->fill($validatedData);

        $this->customer->save();

        return redirect()
            ->route(
                'customers.edit',
                [
                    'customer' => $this->customer->id,
                ]
            );
    }

    /**
     * Bind data.
     *
     * @param Customer $customer
     */
    public function mount(Customer $customer)
    {
        $this->customer = $customer;

        $this->customer->name = __('model.customer.new');
    }

    /**
     * Render component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.customers.create');
    }
}

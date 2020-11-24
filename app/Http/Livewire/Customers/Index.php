<?php

namespace App\Http\Livewire\Customers;

use App\Http\Livewire\TableComponent;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Customer index component.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class Index extends TableComponent
{
    use HtmlComponents;

    /**
     * Get query.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Customer::query();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make('#', Customer::ATTR_ID)
                ->searchable()
                ->sortable()
                ->format(function(Customer $model) {
                    return $this->link(route('customers.edit', ['customer' => $model->id]), $model->id);
                }),
            Column::make(
                __(
                    'model.customer.property.name'),
                Customer::ATTR_NAME
                )
                ->searchable()
                ->sortable()
                ->format(function(Customer $model) {
                    return $this->link(route('customers.edit', ['customer' => $model->id]), $model->name);
                }),
            Column::make('', null)
                ->format(function (Customer $model) {
                    $html = '<div class="actions text-right">';

                    $html .= '<a class="text-gray-300 ml-2 hover:bg-indigo-500" href="'
                        . route('customers.edit', ['customer' => $model->id])
                        . '"><i class="fas fa-edit"></i></a>';

                    if ($model->isDeletable()) {
                        $html .= '<a class="text-gray-300 ml-2 hover:text-red-500" href="'
                            . route('customers.delete', ['customer' => $model->id])
                            . '"><i class="fas fa-trash-alt hover:text-red-500"></i></a>';
                    }

                    $html .= '</div>';

                    return $this->html(
                        $html
                    );
                }),

        ];
    }
}

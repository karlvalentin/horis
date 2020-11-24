<?php

namespace App\Http\Livewire\Activities;

use App\Http\Livewire\TableComponent;
use App\Models\Activity;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Index extends TableComponent
{
    use HtmlComponents;

    public function query(): Builder
    {
        return Activity::query();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->searchable()
                ->sortable()
                ->format(function(Activity $model) {
                    return $this->link(route('activities.edit', ['activity' => $model->id]), $model->id);
                }),
            Column::make(__('model.activity.property.name'), Activity::ATTR_NAME)
                ->searchable()
                ->sortable()
                ->format(function(Activity $model) {
                    return $this->link(route('activities.edit', ['activity' => $model->id]), $model->name);
                }),
            Column::make('', null)
                ->format(function (Activity $model) {
                    $html = '<div class="actions text-right">';

                    $html .= '<a class="text-gray-300 ml-2 hover:bg-indigo-500" href="'
                        . route('activities.edit', ['activity' => $model->id])
                        . '"><i class="fas fa-edit"></i></a>';

                    if ($model->isDeletable()) {
                        $html .= '<a class="text-gray-300 ml-2 hover:text-red-500" href="'
                            . route('activities.delete', ['activity' => $model->id])
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

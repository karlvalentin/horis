<?php

namespace App\Http\Livewire\Projects;

use App\Http\Livewire\TableComponent;
use App\Http\Livewire\TableComponent\Lens;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Index extends TableComponent
{
    use HtmlComponents;

    public function query(): Builder
    {
        return Project::query();
    }

    public function columns(): array
    {
        return [
            Column::make('#', Project::ATTR_ID)
                ->searchable()
                ->sortable()
                ->format(function(Project $model) {
                    return $this->link(route('projects.edit', ['project' => $model->id]), $model->id);
                }),
            Column::make(__('model.project.property.name'), Project::ATTR_NAME)
                ->searchable()
                ->sortable()
                ->format(function(Project $model) {
                    return $this->link(route('projects.edit', ['project' => $model->id]), $model->name);
                }),
            Column::make('Status', Project::ATTR_ACTIVE)
                ->sortable()
                ->format(function (Project $model) {
                    return $this->html(
                        '<i class="fas fa-circle text-' . ($model->active ? 'green' : 'red') . '-500"></i>'
                    );
                }),
            Column::make('', null)
                ->format(function (Project $model) {
                    $html = '<div class="actions text-right">';

                    $html .= '<a class="text-gray-300 ml-2 hover:bg-indigo-500" href="'
                        . route('projects.edit', ['project' => $model->id])
                        . '"><i class="fas fa-edit"></i></a>';

                    if ($model->isDeletable()) {
                        $html .= '<a class="text-gray-300 ml-2 hover:text-red-500" href="'
                            . route('projects.delete', ['project' => $model->id])
                            . '"><i class="fas fa-trash-alt hover:text-red-500"></i></a>';
                    }

                    $html .= '</div>';

                    return $this->html(
                        $html
                    );
                }),
        ];
    }

    public function lenses(): array
    {
        return [
            (new Lens('all'))
                ->label(__('model.project.lenses.all')),
            (new Lens('active'))
                ->label(__('model.project.lenses.active'))
                ->query(function($query) {
                    $query->where(Project::ATTR_ACTIVE, true);
                }),
            (new Lens('inactive'))
                ->label(__('model.project.lenses.inactive'))
                ->query(function($query) {
                    $query->where(Project::ATTR_ACTIVE, false);
                }),
        ];
    }


}

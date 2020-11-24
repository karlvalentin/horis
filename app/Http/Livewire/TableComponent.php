<?php


namespace App\Http\Livewire;

use App\Http\Livewire\TableComponent\Lens;
use Illuminate\Database\Eloquent\Builder;

/**
 * Livewire table component.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
abstract class TableComponent
    extends \Rappasoft\LaravelLivewireTables\TableComponent
{
    public $perPage = 10;

    public $loadingIndicator = false;

    /**
     * The default sort icon.
     *
     * @var string
     */
    public $sortDefaultIcon = '<i class="text-muted fas fa-sort text-gray-300 mx-2"></i>';

    /**
     * The sort icon when currently sorting ascending.
     *
     * @var string
     */
    public $ascSortIcon = '<i class="fas fa-sort-up text-gray-300 mx-2"></i>';

    /**
     * The sort icon when currently sorting descending.
     *
     * @var string
     */
    public $descSortIcon = '<i class="fas fa-sort-down text-gray-300 mx-2"></i>';

    public $lens;

    /**
     * Get models.
     *
     * @return Builder
     */
    public function models(): Builder
    {
        $builder = parent::models();

        if ($this->lens) {
            $lens = $this->lens($this->lens);

            $builder->where($lens->query);
        }

        return $builder;
    }

    /**
     * Get lenses.
     *
     * @return array|Lens[]
     */
    public function lenses(): array
    {
        return [];
    }

    /**
     * Get lens by identifier.
     *
     * @param string $identifier
     *
     * @return Lens|null
     */
    public function lens(string $identifier): ?Lens
    {
        foreach ($this->lenses() as $lens) {
            if ($lens->identifier === $identifier) {
                return $lens;
            }
        }

        return null;
    }
}

@if ($paginationEnabled)
    <div class="row">
        <div class="col">
            {{ $models->links() }}
        </div>

        <div class="col text-center text-muted text-gray-500 my-8">
            @lang(
                'laravel-livewire-tables::strings.results',
                [
                    'first' => $models->count() ? $models->firstItem() : 0,
                    'last' => $models->count() ? $models->lastItem() : 0,
                    'total' => $models->total()
                ]
            )
        </div>
    </div>
@endif

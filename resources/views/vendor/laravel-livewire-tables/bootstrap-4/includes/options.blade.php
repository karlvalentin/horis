@if ($paginationEnabled || $searchEnabled)
    <div class="flex flex-col sm:flex-row mb-4">
        @if ($searchEnabled)
            <div class="w-full flex-grow flex sm:flex-row">
                @if ($clearSearchButton)
                    <div class="input-group w-full">
                        @endif
                        <div class="flex-shrink">
                            <i class="fas fa-search text-gray-300 py-3"></i>
                        </div>
                        <div class="flex-grow">
                            <input
                                @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                            @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                                @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                                class="focus:outline-none p-2 rounded-lg w-full"
                                type="text"
                                placeholder="{{ __('laravel-livewire-tables::strings.search') }}"
                            />
                        </div>
                        @if ($clearSearchButton)
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="button" wire:click="clearSearch">@lang('laravel-livewire-tables::strings.clear')</button>
                            </div>
                    </div>
                @endif
            </div>
        @endif

        @if($this->lenses())
            <div class="w-full sm:w-auto sm:flex-shrink">
                <select id="lens"
                        name="lens"
                        wire:model="lens"
                        class="rounded-lg bg-white pl-4 pr-2 py-2 focus:outline-none sm:text-right">
                    @foreach($this->lenses() as $lens)
                        <option value="{{ $lens->identifier }}">{{ $lens->label }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if ($paginationEnabled && count($perPageOptions))
            <div class="w-full sm:w-auto sm:flex-shrink nowrap form-inline sm:text-right sm:ml-8">
                @lang('laravel-livewire-tables::strings.per_page'): &nbsp;

                <select wire:model="perPage" class="rounded-lg bg-white pl-4 pr-2 py-2 focus:outline-none">
                    @foreach ($perPageOptions as $option)
                        <option>{{ $option }}</option>
                    @endforeach
                </select>
            </div><!--col-->
        @endif

        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.export')
    </div><!--row-->
@endif

<div>
    <h2 class="border-b"> {{ $project->name }}</h2>
    @include('partials.messages')
    <form wire:submit.prevent="save">
        <div class="input-group">
            <label class="" for="name">
                {{ __('model.project.nameit') }}
            </label>
            <input wire:model="project.name"
                   class="w-full md:w-1/2 @error('name') error @enderror"
                   type="text"
                   id="name"
                   name="name">
        </div>
        <div class="input-group">
            <label for="active">
                <input id="active" name="active" type="checkbox" wire:model="project.active" value="{{ $project->active }}"> {{ __('model.project.active') }}
            </label>
        </div>
        <button type="submit" class="button button-success">
            {{ __('model.project.create') }}
        </button>
    </form>
</div>

<div>
    <h2 class="border-b"> {{ $activity->name }}</h2>
    @include('partials.messages')
    <form wire:submit.prevent="save">
        <div class="input-group">
            <label class="" for="name">
                {{ __('model.activity.name') }}
            </label>
            <input wire:model="activity.name"
                   class="w-full md:w-1/2 @error('name') error @enderror"
                   type="text"
                   id="name"
                   name="name">
        </div>
        <button type="submit" class="button button-success">
            {{ __('model.activity.create') }}
        </button>
    </form>
</div>

<div>
    <h2 class="border-b"> {{ $customer->name }}</h2>
    @include('partials.messages')
    <form wire:submit.prevent="save">
        <div class="input-group">
            <label class="" for="name">
                {{ __('model.customer.name') }}
            </label>
            <input wire:model="customer.name"
                   class="w-full md:w-1/2 @error('name') error @enderror"
                   type="text"
                   id="name"
                   name="name">
        </div>
        <button type="submit" class="button button-success">
            {{ __('model.customer.create') }}
        </button>
    </form>
</div>

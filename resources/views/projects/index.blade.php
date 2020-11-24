<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
                {{ __('model.project.plural') }}
            </h2>
            <div class="flex-shrink">
                <a href="{{ route('projects.create') }}"
                   class="button button-light">
                    <i class="fas fa-plus mr-2"></i>
                    {{ __('model.project.new') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.messages')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <livewire:projects.index />
            </div>
        </div>
    </div>
</x-app-layout>

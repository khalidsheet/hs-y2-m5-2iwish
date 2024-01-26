<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wishes you\'ve received!') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-4 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('wish-list', ['canDelete' => true, 'canEditPrivacy' => true])
        </div>
    </div>
</x-app-layout>

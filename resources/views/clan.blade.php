<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $clan->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl pt-6 mx-auto sm:px-6 lg:px-8">
        <clan-alerts istatus="{{ $clan->status }}"></clan-alerts>
    </div>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <clan-settings :clanid="{{ $clan->id }}" :isettings="{{ $clan->settings }}"></clan-settings>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl pt-6 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <clan-webhooks :clanid="{{ $clan->id }}" :ikeys="{{ $clan->secrets }}"></clan-webhooks>
            </div>
        </div>
    </div>
</x-app-layout>

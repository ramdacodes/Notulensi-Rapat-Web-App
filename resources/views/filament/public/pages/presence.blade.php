<x-filament-panels::page>
    <x-filament::section>
        <div class="flex items-center mb-4 space-x-6">
            <img src="{{ asset('images/usb-logo.png') }}" alt="App Logo" class="w-20 h-20 shadow-md" style="margin-right: 10px">

            <div>
                <h2 class="text-xl font-semibold text-gray-800">Presence Minutes of Meeting</h2>
                <p class="text-sm text-gray-600">Smart application to record and manage meeting minutes easily and efficiently.</p>
                <p class="text-sm text-gray-500">Version: 1.0.0</p>
            </div>
        </div>

        <form wire:submit="submit">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-3" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                {{ __('Submit') }}
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-panels::page>

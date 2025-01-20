<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit="filter">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-3" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                {{ __('Search presence') }}
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>

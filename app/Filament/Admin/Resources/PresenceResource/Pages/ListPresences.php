<?php

namespace App\Filament\Admin\Resources\PresenceResource\Pages;

use App\Filament\Admin\Resources\PresenceResource;
use App\Filament\Admin\Resources\PresenceResource\Widgets\FilterPresenceByAgenda;
use App\Models\Presence;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class ListPresences extends ListRecords
{
    protected static string $resource = PresenceResource::class;

    protected static ?string $title = 'Presence';

    protected function getHeaderWidgets(): array
    {
        return [
            FilterPresenceByAgenda::class,
        ];
    }

    protected array $queryString = [];

    public ?int $agenda_id = null;

    public function mount(): void
    {
        $this->agenda_id = null;
    }

    #[On('presence-filter-changed')]
    public function updateFilter(?int $agendaId): void
    {
        $this->agenda_id = $agendaId;
        $this->resetPage();
    }

    public function getTableQuery(): Builder
    {
        $query = Presence::query()
            ->when($this->agenda_id, fn ($query) => $query->where('agenda_id', $this->agenda_id))
            ->when(!$this->agenda_id, fn ($query) => $query->whereNull('agenda_id'));

        return $query;
    }
}

<?php

namespace App\Filament\Admin\Resources\PresenceResource\Widgets;

use App\Models\Agenda;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class FilterPresenceByAgenda extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.admin.resources.presence-resource.widgets.filter-presence-by-agenda';

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agenda_id')
                    ->label('Agenda')
                    ->options(Agenda::all()->pluck('name', 'agenda_id'))
                    ->placeholder('Please select agenda')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function filter(): void
    {
         $this->dispatch('presence-filter-changed', agendaId: $this->data['agenda_id'] ?? null);
    }
}

<?php

namespace App\Filament\Admin\Resources\AgendaResource\Pages;

use App\Filament\Admin\Resources\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgendas extends ListRecords
{
    protected static string $resource = AgendaResource::class;

    protected static ?string $title = 'Agenda';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Agenda'),
        ];
    }
}

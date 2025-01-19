<?php

namespace App\Filament\Notulis\Resources\NotulensiResource\Pages;

use App\Filament\Notulis\Resources\NotulensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotulensis extends ListRecords
{
    protected static string $resource = NotulensiResource::class;

    protected static ?string $title = "Notulensi";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Notulensi'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\NotulisResource\Pages;

use App\Filament\Admin\Resources\NotulisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotulis extends ListRecords
{
    protected static string $resource = NotulisResource::class;

    protected static ?string $title = 'Notulis';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Notulis'),
        ];
    }
}

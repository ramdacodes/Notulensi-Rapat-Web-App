<?php

namespace App\Filament\Resources\NotulisResource\Pages;

use App\Filament\Resources\NotulisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotulis extends EditRecord
{
    protected static string $resource = NotulisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

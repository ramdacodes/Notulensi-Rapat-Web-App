<?php

namespace App\Filament\Notulis\Resources\NotulensiResource\Pages;

use App\Filament\Notulis\Resources\NotulensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotulensi extends EditRecord
{
    protected static string $resource = NotulensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

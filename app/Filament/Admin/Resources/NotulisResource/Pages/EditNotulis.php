<?php

namespace App\Filament\Admin\Resources\NotulisResource\Pages;

use App\Filament\Admin\Resources\NotulisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotulis extends EditRecord
{
    protected static string $resource = NotulisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

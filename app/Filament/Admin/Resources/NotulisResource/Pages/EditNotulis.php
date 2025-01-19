<?php

namespace App\Filament\Admin\Resources\NotulisResource\Pages;

use App\Filament\Admin\Resources\NotulisResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditNotulis extends EditRecord
{
    protected static string $resource = NotulisResource::class;

    protected static ?string $title = 'Edit Notulis';

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Notulis updated successfully');
    }

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

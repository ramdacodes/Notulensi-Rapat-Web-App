<?php

namespace App\Filament\Admin\Resources\NotulisResource\Pages;

use App\Filament\Admin\Resources\NotulisResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateNotulis extends CreateRecord
{
    protected static string $resource = NotulisResource::class;

    protected static ?string $title = 'Create Notulis';

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Notulis created successfully');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

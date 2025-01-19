<?php

namespace App\Filament\Notulis\Resources\NotulensiResource\Pages;

use App\Filament\Notulis\Resources\NotulensiResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateNotulensi extends CreateRecord
{
    protected static string $resource = NotulensiResource::class;


    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Notulensi created successfully');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

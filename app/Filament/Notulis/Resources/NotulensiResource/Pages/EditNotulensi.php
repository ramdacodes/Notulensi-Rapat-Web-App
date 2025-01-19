<?php

namespace App\Filament\Notulis\Resources\NotulensiResource\Pages;

use App\Filament\Notulis\Resources\NotulensiResource;
use App\Models\Notulensi;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditNotulensi extends EditRecord
{
    protected static string $resource = NotulensiResource::class;

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Notulensi updated successfully');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function (Notulensi $record) {
                    if ($record->attachments) {
                        foreach ($record->attachments as $attachment) {
                            Storage::disk('public')->delete($attachment);
                        }
                    }
                }),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\NotulisResource\Pages;

use App\Filament\Admin\Resources\NotulisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotulis extends CreateRecord
{
    protected static string $resource = NotulisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

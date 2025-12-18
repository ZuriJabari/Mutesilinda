<?php

namespace App\Filament\Resources\LibraryHoldResource\Pages;

use App\Filament\Resources\LibraryHoldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibraryHold extends EditRecord
{
    protected static string $resource = LibraryHoldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\TokosResource\Pages;

use App\Filament\Resources\TokosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTokos extends EditRecord
{
    protected static string $resource = TokosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

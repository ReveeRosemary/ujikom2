<?php

namespace App\Filament\Resources\TokoResource\Pages;

use App\Filament\Resources\TokoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTokos extends ListRecords
{
    protected static string $resource = TokoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

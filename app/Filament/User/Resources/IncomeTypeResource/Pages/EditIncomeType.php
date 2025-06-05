<?php

namespace App\Filament\User\Resources\IncomeTypeResource\Pages;

use App\Filament\User\Resources\IncomeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomeType extends EditRecord
{
    protected static string $resource = IncomeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

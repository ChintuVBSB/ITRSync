<?php

namespace App\Filament\User\Resources\PersonResource\Pages;

use App\Filament\User\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{   
    protected static string $resource = PersonResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
    return $data;
}
}

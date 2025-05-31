<?php

namespace App\Filament\User\Resources\PersonResource\Pages;

use App\Filament\User\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePerson extends CreateRecord
{   
    protected static string $resource = PersonResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->bankDetails = $data['bank_details'] ?? [];
        unset($data['bank_details']);
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $person = static::getModel()::create($data);

        foreach ($this->bankDetails as $bankData) 
        {
            $person->bankDetails()->create($bankData);
        }

        return $person;
    }
}

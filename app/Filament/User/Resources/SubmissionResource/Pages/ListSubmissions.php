<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissions extends ListRecords
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

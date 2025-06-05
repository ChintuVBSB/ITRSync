<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubmission extends ViewRecord
{
    protected static string $resource = SubmissionResource::class;

    protected static string $view = "filament.resources.submission.view-submission"; 
}

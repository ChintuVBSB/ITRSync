<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use Filament\Resources\Pages\Page;
use App\Models\Submission;

class ViewSubmission extends Page
{
    protected static string $resource = SubmissionResource::class;

    public Submission $submission;

    protected static string $view = 'filament.user.resources.submission-resource.pages.view-submission';

    public function mount($record): void
    {
        $this->submission = Submission::with(['person', 'incomeTypes', 'deductionTypes'])->findOrFail($record);
    }
}

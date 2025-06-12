<?php

namespace App\Livewire\User;

use App\Models\Submission;
use Livewire\Component;

class SubmissionDetails extends Component
{
    public Submission $submission;

    protected $listeners = [
        'child-saved' => 'handleChildSaved',
    ];

    public function mount($submissionId)
    {
        $this->submission = Submission::with([
            'person',
            'incomeTypes',
            'deductionTypes',
            'incomeFromSalary',
            'incomeFromHouseProperty',
            'incomeFromBusiness',
            'incomeFromOtherSources',
            'deduction80C',
            'deduction80D',
            'deduction80E',
            'deduction80G',
            'deductionOther',
        ])->findOrFail($submissionId);
    }

    public function saveAsDraftAndRedirect()
{
    $this->dispatch('save-salary')->to('income-from-salary-form');
    $this->dispatch('save-house')->to('income-from-house-property-form'); 

    usleep(500000);

    $this->redirect(route('user.submissions.preview.view', $this->submission->id));
}

    public function render()
    {
        return view('livewire.user.submission-details', [
            'submission' => $this->submission,
        ]);
    }

    public function handleChildSaved()
    {
        // Optional: logic when child emits 'child-saved'
    }
}

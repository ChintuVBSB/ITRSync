<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Submission;

class SubmissionPreview extends Component
{
    public Submission $submission;

    public function mount($submissionId)
    {
        $this->submission = Submission::with([
            'person',
            'incomeTypes',
            'deductionTypes',
            'incomeFromSalary',
            'deduction80C',
            'deduction80D',
            'deduction80E', 
            'deduction80G',
            'deductionOther',
            'incomeFromHouseProperty.rentedProperties',
            'incomeFromHouseProperty.selfOccupiedProperties',
            'incomeFromCapitalGains',
            'incomeFromOtherSources',
        ])->findOrFail($submissionId);
    }

    public function submitFinal()
    {
        $this->submission->submitted_at = now();
        $this->submission->save();

        session()->flash('message', 'Submission finalized successfully.');
        return redirect()->route('submission.details', ['submissionId' => $this->submission->id]);
    }

    public function render()
    {
        return view('livewire.user.submission-preview');
    }
}

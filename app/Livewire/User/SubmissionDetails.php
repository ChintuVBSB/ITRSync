<?php

namespace App\Livewire\User;

use App\Models\Submission;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Person;

class SubmissionDetails extends Component
{
    public Submission $submission;

    #[\Livewire\Attributes\Url]
    public $submissionId;

    public function mount($submissionId)
    {
        $this->submission = Submission::with(['person', 'incomeTypes', 'deductionTypes'])->findOrFail($submissionId);
    }

    public function render()
    {
        return view('livewire.user.submission-details');
    }
}

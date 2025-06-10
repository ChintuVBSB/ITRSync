<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Deduction80E;

class Deduction80EForm extends Component
{
    use WithFileUploads;

    public Submission $submission;
    public $educationLoanCertificate;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function save()
    {
        $path = $this->educationLoanCertificate?->store('uploads/80e', 'public');

        Deduction80E::updateOrCreate(
            ['submission_id' => $this->submission->id],
            ['education_loan_certificate' => $path]
        );

        session()->flash('message', '80E Education Loan certificate saved.');
    }

    public function render()
    {
        return view('livewire.deduction80-e-form');
    }
}

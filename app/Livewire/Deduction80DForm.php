<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Deduction80D;

class Deduction80DForm extends Component
{
    use WithFileUploads;

    public Submission $submission;
    public $healthInsurance;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function save()
    {
        $path = $this->healthInsurance ? [$this->healthInsurance->store('uploads/80d/health', 'public')] : null;

        Deduction80D::updateOrCreate(
            ['submission_id' => $this->submission->id],
            ['mediclaim_receipts' => $path]
        );

        session()->flash('message', '80D Mediclaim saved successfully.');
    }

    public function render()
    {
        return view('livewire.deduction80-d-form');
    }
}

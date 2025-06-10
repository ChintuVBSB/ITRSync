<?php

namespace App\Livewire;

use App\Models\DeductionOtherDocument;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;


class DeductionOtherForm extends Component
{
    use WithFileUploads;

    public Submission $submission;
    public $document;
    public $description;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
        $existing = DeductionOtherDocument::where('submission_id', $submission->id)->first();

        if ($existing) {
            $this->description = $existing->description;
        }
    }

    public function save()
    {
        $path = $this->document?->store('uploads/other-deductions', 'public');

        DeductionOtherDocument::updateOrCreate(
            ['submission_id' => $this->submission->id],
            [
                'document' => $path,
                'description' => $this->description,
            ]
        );

        session()->flash('message', 'Other deduction saved successfully.');
    }

    public function render()
    {
        return view('livewire.deduction-other-form');
    }
}

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

    // 1. Validation rules
    protected $rules = [
        'document'    => 'required|file|max:10240',    // max 10 MB
        'description' => 'nullable|string|max:255',
    ];

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function save()
    {
        // 2. This will throw a validation error if no file was uploaded.
        $validated = $this->validate();

        // At this point, $validated['document'] is guaranteed to be an UploadedFile
        $path = $validated['document']->store('uploads/other-deductions', 'public');

        // Fetch or create the JSON record
        $other = DeductionOtherDocument::firstOrNew([
            'submission_id' => $this->submission->id,
        ]);

        // Append to the JSON array
        $docs = $other->other_deduction_documents ?? [];
        $docs[] = [
            'path'        => $path,
            'description' => $validated['description'],
            'uploaded_at' => now()->toDateTimeString(),
        ];

        $other->other_deduction_documents = $docs;
        $other->save();

        session()->flash('message', 'Other deduction saved successfully.');

        // Reset inputs so the form is clear for the next upload
        $this->reset(['document', 'description']);
    }

    public function render()
    {
        return view('livewire.deduction-other-form');
    }
}

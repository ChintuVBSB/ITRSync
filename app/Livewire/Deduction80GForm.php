<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Deduction80G;

class Deduction80GForm extends Component
{
    use WithFileUploads;

    public Submission $submission;
    public $donationReceipt;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function save()
    {
        $path = $this->donationReceipt?->store('uploads/80g/donations', 'public');

        Deduction80G::updateOrCreate(
            ['submission_id' => $this->submission->id],
            ['donation_receipt' => $path]
        );

        session()->flash('message', '80G Donation receipt saved successfully.');
    }

    public function render()
    {
        return view('livewire.deduction80-g-form');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\DeductionDonation;

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

        DeductionDonation::updateOrCreate(
            ['submission_id' => $this->submission->id],
            ['donation_receipts' => [$path]]
        );

        session()->flash('message', '80G Donation receipt saved successfully.');
    }

    public function render()
    {
        return view('livewire.deduction80-g-form');
    }
}

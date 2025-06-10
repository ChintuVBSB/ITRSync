<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Deduction80C;

class Deduction80CForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public $lifeInsurance;
    public $ppf;
    public $epf;
    public $mutualFunds;
    public $tuitionFees;
    public $otherProofs;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;

        $deduction = Deduction80C::where('submission_id', $submission->id)->first();
        if ($deduction) {
            // We don't preload files here, just structure if needed
        }
    }

    public function save()
    {
        $deduction = Deduction80C::updateOrCreate(
            ['submission_id' => $this->submission->id],
            [
                'life_insurance' => $this->lifeInsurance?->store('uploads/80c/life', 'public'),
                'ppf' => $this->ppf?->store('uploads/80c/ppf', 'public'),
                'epf' => $this->epf?->store('uploads/80c/epf', 'public'),
                'mutual_funds' => $this->mutualFunds?->store('uploads/80c/mutual', 'public'),
                'tuition_fees' => $this->tuitionFees?->store('uploads/80c/tuition', 'public'),
                'other_proofs' => $this->otherProofs?->store('uploads/80c/other', 'public'),
            ]
        );

        session()->flash('message', '80C Deduction documents saved.');
    }

    public function render()
    {
        return view('livewire.deduction80-c-form');
    }
}

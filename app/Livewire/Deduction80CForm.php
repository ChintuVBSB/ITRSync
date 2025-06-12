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

    public $lifeInsurance = [];
    public $ppf = [];
    public $epf = [];
    public $mutualFunds = [];
    public $tuitionFees = [];
    public $otherProofs = [];
    protected $listeners = ['save-80c' => 'save'];
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
    Deduction80C::updateOrCreate(
        ['submission_id' => $this->submission->id],
        [
            'life_insurance_receipts' => $this->lifeInsurance ? collect($this->lifeInsurance)->map(fn($file) => $file->store('uploads/80c/life', 'public')) : null,
            'ppf_statements' => $this->ppf ? collect($this->ppf)->map(fn($file) => $file->store('uploads/80c/ppf', 'public')) : null,
            'epf_statements' => $this->epf ? collect($this->epf)->map(fn($file) => $file->store('uploads/80c/epf', 'public')) : null,
            'mutual_fund_fds' => $this->mutualFunds ? collect($this->mutualFunds)->map(fn($file) => $file->store('uploads/80c/mutual', 'public')) : null,
            'tuition_fee_receipts' => $this->tuitionFees ? collect($this->tuitionFees)->map(fn($file) => $file->store('uploads/80c/tuition', 'public')) : null,
            'other_investment_proofs' => $this->otherProofs ? collect($this->otherProofs)->map(fn($file) => $file->store('uploads/80c/other', 'public')) : null,
        ]
    );

    session()->flash('message', '80C Deduction documents saved.');
}


    public function render()
    {
        return view('livewire.deduction80-c-form');
    }
}

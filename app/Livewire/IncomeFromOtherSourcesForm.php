<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\IncomeFromOtherSource;

class IncomeFromOtherSourcesForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public $interestCertificate;
    public $cryptoStatement;

    public $dividendCompany;
    public $dividendAmount;

    public $otherPartyName;
    public $otherPartyAmount;

    public $otherDescription;
    public $otherAmount;
    protected $listeners = ['save-others' => 'save'];

    public function mount(Submission $submission): void
    {
        $this->submission = $submission;

        $record = IncomeFromOtherSource::where('submission_id', $submission->id)->first();
        if ($record) {
            $this->dividendCompany = $record->dividend_company;
            $this->dividendAmount = $record->dividend_amount;
            $this->otherPartyName = $record->other_party_name;
            $this->otherPartyAmount = $record->other_party_amount;
            $this->otherDescription = $record->other_description;
            $this->otherAmount = $record->other_amount;
        }
    }

    public function save(): void
    {
        $interestCertificatePath = $this->interestCertificate?->store('uploads/other/interest', 'public');
        $cryptoStatementPath = $this->cryptoStatement?->store('uploads/other/crypto', 'public');

        IncomeFromOtherSource::updateOrCreate(
            ['submission_id' => $this->submission->id],
            [
                'interest_certificate' => $interestCertificatePath,
                'crypto_statement' => $cryptoStatementPath,
                'dividend_company' => $this->dividendCompany,
                'dividend_amount' => $this->dividendAmount,
                'other_party_name' => $this->otherPartyName,
                'other_party_amount' => $this->otherPartyAmount,
                'other_description' => $this->otherDescription,
                'other_amount' => $this->otherAmount,
            ]
        );

        session()->flash('message', 'Other Sources income saved successfully!');
    }

    public function render()
    {
        return view('livewire.income-from-other-sources-form');
    }
}

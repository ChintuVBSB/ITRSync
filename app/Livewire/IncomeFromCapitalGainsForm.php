<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\IncomeFromCapitalGain;

class IncomeFromCapitalGainsForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public $dematStatement;
    public $saleDeed;
    public $purchaseDeed;
    public $improvementExpense;
    protected $listeners = ['save-capital-gains' => 'save'];
    public function mount(Submission $submission)
    {
        $this->submission = $submission;

        $record = IncomeFromCapitalGain::where('submission_id', $submission->id)->first();
        if ($record) {
            $this->improvementExpense = $record->improvement_expense_details;
        }
    }

    public function save()
{
    $demat = $this->dematStatement ? [$this->dematStatement->store('uploads/capital_gains/demat', 'public')] : [];
    $sale = $this->saleDeed ? [$this->saleDeed->store('uploads/capital_gains/sale', 'public')] : [];
    $purchase = $this->purchaseDeed ? [$this->purchaseDeed->store('uploads/capital_gains/purchase', 'public')] : [];

    IncomeFromCapitalGain::updateOrCreate(
        ['submission_id' => $this->submission->id],
        [
            'demat_statements' => $demat,
            'sale_deeds' => $sale,
            'purchase_deeds' => $purchase,
            'improvement_expense_details' => $this->improvementExpense,
        ]
    );

    session()->flash('message', 'Capital Gains data saved.');
}




    public function render()
    {
        return view('livewire.income-from-capital-gains-form');
    }
}

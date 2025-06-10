<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\IncomeFromBusiness;
use App\Models\PresumptiveBusiness;
use App\Models\NormalBusiness;
use App\Models\FirmIncome;

class IncomeFromBusinessForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public array $presumptive = [];
    public $normalSales;
    public $normalExpenses;
    public $plStatement;

    public $firmNamePan;
    public $firmSharePercent;
    public $firmRemuneration;
    public $firmInterest;
    public $firmProfitOrLoss;
    public $firmClosingBalance;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;
        $income = $submission->incomeFromBusiness()->with(['presumptiveBusinesses', 'normalBusinesses', 'firmIncomes'])->first();

        if ($income) {
            $this->presumptive = $income->presumptiveBusinesses->map(fn($p) => [
                'name' => $p->name,
                'bank_sales' => $p->bank_sales,
                'cash_sales' => $p->cash_sales,
            ])->toArray();

            $normal = $income->normalBusinesses->first();
            if ($normal) {
                $this->normalSales = $normal->total_sales;
                $this->normalExpenses = $normal->total_expenses;
            }

            $firm = $income->firmIncomes->first();
            if ($firm) {
                $this->firmNamePan = $firm->name_pan;
                $this->firmSharePercent = $firm->share_percent;
                $this->firmRemuneration = $firm->remuneration;
                $this->firmInterest = $firm->interest;
                $this->firmProfitOrLoss = $firm->profit_or_loss;
                $this->firmClosingBalance = $firm->closing_balance;
            }
        }
    }

    public function addPresumptiveBusiness()
    {
        $this->presumptive[] = ['name' => '', 'bank_sales' => '', 'cash_sales' => ''];
    }

    public function removePresumptiveBusiness($index)
    {
        unset($this->presumptive[$index]);
        $this->presumptive = array_values($this->presumptive);
    }

    public function save()
    {
        $income = $this->submission->incomeFromBusiness()->firstOrCreate([
            'submission_id' => $this->submission->id,
        ]);

        $income->presumptiveBusinesses()->delete();
        foreach ($this->presumptive as $b) {
            $income->presumptiveBusinesses()->create([
                'name' => $b['name'],
                'bank_sales' => $b['bank_sales'],
                'cash_sales' => $b['cash_sales'],
            ]);
        }

        $plFile = $this->plStatement?->store('uploads/business/pl', 'public');

        $income->normalBusinesses()->delete();
        $income->normalBusinesses()->create([
            'total_sales' => $this->normalSales,
            'total_expenses' => $this->normalExpenses,
            'pl_statement' => $plFile,
        ]);

        $income->firmIncomes()->delete();
        $income->firmIncomes()->create([
            'name_pan' => $this->firmNamePan,
            'share_percent' => $this->firmSharePercent,
            'remuneration' => $this->firmRemuneration,
            'interest' => $this->firmInterest,
            'profit_or_loss' => $this->firmProfitOrLoss,
            'closing_balance' => $this->firmClosingBalance,
        ]);

        session()->flash('message', 'Business income saved.');
    }

    public function render()
    {
        return view('livewire.income-from-business-form');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\IncomeFromSalary;

class IncomeFromSalaryForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    // File uploads (multiple)
    public array $form16 = [];
    public array $salarySlips = [];
    public array $arrearSheet = [];

    protected $listeners = ['save-salary' => 'save'];

    // Text/Number fields
    public $employerPan;
    public $employerAddress;
    public $salaryAmount;

    public $hraRentPaid;
    public $hraCity;
    public $hraLandlordName;
    public $hraPropertyAddress;

    public function mount(Submission $submission)
    {
        $this->submission = $submission;

        // Load saved salary record if exists
        $salary = IncomeFromSalary::where('submission_id', $submission->id)->first();

        if ($salary) {
            $this->employerPan = $salary->employer_pan;
            $this->employerAddress = $salary->employer_address;
            $this->salaryAmount = $salary->salary_amount;
            $this->hraRentPaid = $salary->hra_rent_paid;
            $this->hraCity = $salary->hra_city;
            $this->hraLandlordName = $salary->hra_landlord_name;
            $this->hraPropertyAddress = $salary->hra_property_address;

            $this->form16 = $salary->form_16 ?? [];
            $this->salarySlips = $salary->salary_slips ?? [];
            $this->arrearSheet = $salary->arrear_sheets ?? [];
        }
    }

    public function save()
    {
        $form16Paths = collect($this->form16)->map(function ($file) {
            return is_string($file) ? $file : $file->store('uploads/salary/form16', 'public');
        })->toArray();

        $slipPaths = collect($this->salarySlips)->map(function ($file) {
            return is_string($file) ? $file : $file->store('uploads/salary/slips', 'public');
        })->toArray();

        $arrearPaths = collect($this->arrearSheet)->map(function ($file) {
            return is_string($file) ? $file : $file->store('uploads/salary/arrears', 'public');
        })->toArray();

        IncomeFromSalary::updateOrCreate(
            ['submission_id' => $this->submission->id],
            [
                'form_16' => $form16Paths,
                'salary_slips' => $slipPaths,
                'arrear_sheets' => $arrearPaths,
                'employer_pan' => $this->employerPan,
                'employer_address' => $this->employerAddress,
                'salary_amount' => $this->salaryAmount,
                'hra_rent_paid' => $this->hraRentPaid,
                'hra_city' => $this->hraCity,
                'hra_landlord_name' => $this->hraLandlordName,
                'hra_property_address' => $this->hraPropertyAddress,
            ]
        );

        session()->flash('message', 'Income from Salary saved successfully!');
    }

    public function render()
    {
        return view('livewire.income-from-salary-form');
    }
}

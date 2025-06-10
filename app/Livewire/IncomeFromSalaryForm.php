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

            // Optional: pre-fill file paths if needed
            // $this->form16 = json_decode($salary->form_16, true) ?? [];
            // $this->salarySlips = json_decode($salary->salary_slips, true) ?? [];
            // $this->arrearSheet = json_decode($salary->arrear_sheets, true) ?? [];
        }
    }

    public function save()
    {
        $form16Paths = collect($this->form16)->map(fn($file) => $file->store('uploads/salary/form16', 'public'))->toArray();
        $slipPaths = collect($this->salarySlips)->map(fn($file) => $file->store('uploads/salary/slips', 'public'))->toArray();
        $arrearPaths = collect($this->arrearSheet)->map(fn($file) => $file->store('uploads/salary/arrears', 'public'))->toArray();

        IncomeFromSalary::updateOrCreate(
            ['submission_id' => $this->submission->id],
            [
                'form_16' => json_encode($form16Paths),
                'salary_slips' => json_encode($slipPaths),
                'arrear_sheets' => json_encode($arrearPaths),
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

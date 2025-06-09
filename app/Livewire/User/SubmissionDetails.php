<?php

namespace App\Livewire\User;

use App\Models\Submission;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmissionDetails extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public $data = [
        'income' => [
            'salary' => [
                'form_16' => [],
                'salary_slips' => [],
                'arrear_sheet' => [],
                'employer_pan' => '',
                'employer_address' => '',
                'salary_amount' => '',
                'hra_rent_paid' => '',
                'hra_city' => '',
                'hra_landlord_name' => '',
                'hra_property_address' => '',
            ],
            'house_property' => [
                'rentedProperties' => [
                    [
                        'tenant_name' => '',
                        'rental_income' => '',
                        'property_address' => '',
                        'house_tax_receipt' => null,
                        'interest_certificate' => null,
                        'ownership_percent' => '',
                        'months_occupied' => '',
                    ],
                ],
                'self' => [
                    'address' => '',
                    'ownership_percent' => '',
                    'interest_certificate' => null,
                ],
            ],
            'other_sources' => [
                'interest_certificate' => null,
                'dividend' => [
                    'company' => '',
                    'amount' => '',
                ],
                'otherParty' => [
                    'name' => '',
                    'amount' => '',
                ],
                'crypto_statement' => null,
                'other' => [
                    'description' => '',
                    'amount' => '',
                ],
            ],
            'capitalGains' => [
                'demat_statement' => null,
                'sale_deed' => null,
                'purchase_deed' => null,
                'improvement_expense' => '',
            ],
            'business' => [
                'presumptive' => [
                    [
                        'name' => '',
                        'bank_sales' => '',
                        'cash_sales' => '',
                    ],
                ],
                'normal' => [
                    'sales' => '',
                    'expenses' => '',
                    'pl_statement' => null,
                ],
                'firm' => [
                    'name_pan' => '',
                    'share_percent' => '',
                    'remuneration' => '',
                    'interest' => '',
                    'profit_or_loss' => '',
                    'closing_balance' => '',
                ],
            ],
        ],
        'deductions' => [
            '80C' => [
                'life_insurance' => null,
                'ppf' => null,
                'epf' => null,
                'mutual_funds' => null,
                'tuition_fees' => null,
                'other_proofs' => null,
            ],
            '80D' => [
                'health_insurance' => null,
            ],
            '80E' => [
                'education_loan_certificate' => null,
            ],
            '80G' => [
                'donation_receipt' => null,
            ],
            'other' => [
                'document' => null,
                'description' => '',
            ],
        ],
    ];

    public function mount($submissionId)
    {
        $this->submission = Submission::with(['person', 'incomeTypes', 'deductionTypes'])->findOrFail($submissionId);
    }

    public function addRentedProperty()
    {
        $this->data['income']['house_property']['rentedProperties'][] = [
            'tenant_name' => '',
            'rental_income' => '',
            'property_address' => '',
            'house_tax_receipt' => null,
            'interest_certificate' => null,
            'ownership_percent' => '',
            'months_occupied' => '',
        ];
    }

    public function removeRentedProperty($index)
    {
        unset($this->data['income']['house_property']['rentedProperties'][$index]);
        $this->data['income']['house_property']['rentedProperties'] = array_values($this->data['income']['house_property']['rentedProperties']);
    }

    public function addPresumptiveBusiness()
    {
        $this->data['income']['business']['presumptive'][] = [
            'name' => '',
            'bank_sales' => '',
            'cash_sales' => '',
        ];
    }

    public function removePresumptiveBusiness($index)
    {
        unset($this->data['income']['business']['presumptive'][$index]);
        $this->data['income']['business']['presumptive'] = array_values($this->data['income']['business']['presumptive']);
    }

    private function storeFile($file, $folder = 'uploads')
    {
        return $file ? $file->store($folder, 'public') : null;
    }

    public function save()
    {
        $this->validate([
            'data.income.salary.form_16.*' => 'nullable|file|max:5120',
            'data.income.salary.salary_slips.*' => 'nullable|file|max:5120',
            'data.income.salary.arrear_sheet.*' => 'nullable|file|max:5120',
            'data.income.salary.employer_pan' => 'nullable|string|max:50',
            'data.income.salary.employer_address' => 'nullable|string|max:255',
            'data.income.salary.salary_amount' => 'nullable|numeric',
            'data.income.salary.hra_rent_paid' => 'nullable|numeric',
            'data.income.salary.hra_city' => 'nullable|string|max:100',
            'data.income.salary.hra_landlord_name' => 'nullable|string|max:100',
            'data.income.salary.hra_property_address' => 'nullable|string|max:255',
            'data.income.other_sources.dividend.company' => 'nullable|string|max:255',
            'data.income.other_sources.dividend.amount' => 'nullable|numeric',
            'data.income.other_sources.otherParty.name' => 'nullable|string|max:255',
            'data.income.other_sources.otherParty.amount' => 'nullable|numeric',
            'data.income.other_sources.other.description' => 'nullable|string|max:255',
            'data.income.other_sources.other.amount' => 'nullable|numeric',
            'data.deductions.other.document' => 'nullable|file|max:5120',
            'data.deductions.other.description' => 'nullable|string|max:255',
        ]);

        $this->submission->update([
        'data' => $this->data,
        ]);

        // Handle array-based uploads
        foreach (['form_16', 'salary_slips', 'arrear_sheet'] as $field) {
            foreach ($this->data['income']['salary'][$field] as $key => $file) {
                $this->data['income']['salary'][$field][$key] = $this->storeFile($file);
            }
        }

        // Single file uploads
        $this->data['income']['other_sources']['interest_certificate'] = $this->storeFile($this->data['income']['other_sources']['interest_certificate']);
        $this->data['income']['other_sources']['crypto_statement'] = $this->storeFile($this->data['income']['other_sources']['crypto_statement']);
        $this->data['income']['capitalGains']['demat_statement'] = $this->storeFile($this->data['income']['capitalGains']['demat_statement']);
        $this->data['income']['capitalGains']['sale_deed'] = $this->storeFile($this->data['income']['capitalGains']['sale_deed']);
        $this->data['income']['capitalGains']['purchase_deed'] = $this->storeFile($this->data['income']['capitalGains']['purchase_deed']);
        $this->data['income']['business']['normal']['pl_statement'] = $this->storeFile($this->data['income']['business']['normal']['pl_statement']);
        $this->data['income']['house_property']['self']['interest_certificate'] = $this->storeFile($this->data['income']['house_property']['self']['interest_certificate']);
        $this->data['deductions']['other']['document'] = $this->storeFile($this->data['deductions']['other']['document']);

        // Dynamic arrays (e.g., rentedProperties)
        foreach ($this->data['income']['house_property']['rentedProperties'] as $index => $property) {
            $this->data['income']['house_property']['rentedProperties'][$index]['house_tax_receipt'] = $this->storeFile($property['house_tax_receipt']);
            $this->data['income']['house_property']['rentedProperties'][$index]['interest_certificate'] = $this->storeFile($property['interest_certificate']);
        }

        session()->flash('message', 'Data saved and files uploaded successfully.');
    }

    public function render()
    {
        return view('livewire.user.submission-details', [
            'submission' => $this->submission,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\IncomeFromHouseProperty;
use App\Models\RentedProperty;
use App\Models\SelfOccupiedProperty;

class IncomeFromHousePropertyForm extends Component
{
    use WithFileUploads;

    public Submission $submission;

    public array $rentedInputs = [];
    public $selfAddress;
    public $selfOwnershipPercent;
    public $selfInterestCertificate;

    protected $listeners = ['save-house' => 'save'];

    public function mount(Submission $submission)
    {
        $this->submission = $submission;

        $income = $this->submission->incomeFromHouseProperty()->firstOrCreate([]);

        $self = $income->selfOccupiedProperties()->first();
        if ($self) {
            $this->selfAddress = $self->property_address;
            $this->selfOwnershipPercent = $self->ownership_percent;
        }

        $rented = $income->rentedProperties()->get();
        if ($rented->isNotEmpty()) {
            $this->rentedInputs = $rented->map(function ($r) {
                return [
                    'tenant_name' => $r->tenant_name,
                    'property_address' => $r->property_address,
                    'rental_income' => $r->rental_income,
                    'ownership_percent' => $r->ownership_percent,
                    'months_occupied' => $r->months_occupied,
                    'house_tax_receipt' => null,
                    'interest_certificate' => null,
                ];
            })->toArray();
        } else {
            $this->rentedInputs = [];
            $this->addRentedProperty();
        }
    }

    public function addRentedProperty()
    {
        $this->rentedInputs[] = [
            'tenant_name' => '',
            'property_address' => '',
            'rental_income' => '',
            'ownership_percent' => '',
            'months_occupied' => '',
            'house_tax_receipt' => null,
            'interest_certificate' => null,
        ];
    }

    public function removeRentedProperty($index)
    {
        unset($this->rentedInputs[$index]);
        $this->rentedInputs = array_values($this->rentedInputs);
    }

    public function save()
    {
        $income = IncomeFromHouseProperty::firstOrCreate([
            'submission_id' => $this->submission->id,
        ]);

        $income->rentedProperties()->delete();
        $income->selfOccupiedProperties()->delete();
        \Log::info('Saving rented inputs:', $this->rentedInputs);
        foreach ($this->rentedInputs as $property) {
            $houseTaxReceipt = $property['house_tax_receipt'] ?? null;
            $interestCertificate = $property['interest_certificate'] ?? null;

            $income->rentedProperties()->create([
                'income_from_house_property_id' => $income->id,
                'tenant_name' => $property['tenant_name'] ?: null,
                'property_address' => $property['property_address'] ?: null,
                'rental_income' => is_numeric($property['rental_income']) ? $property['rental_income'] : null,
                'ownership_percent' => is_numeric($property['ownership_percent']) ? $property['ownership_percent'] : null,
                'months_occupied' => is_numeric($property['months_occupied']) ? $property['months_occupied'] : null,
                'house_tax_receipt' => $houseTaxReceipt ? $houseTaxReceipt->store('uploads/property/house_tax', 'public') : null,
                'interest_certificate' => $interestCertificate ? $interestCertificate->store('uploads/property/interest', 'public') : null,
            ]);
        }

        if ($this->selfAddress || $this->selfOwnershipPercent || $this->selfInterestCertificate) {
            $income->selfOccupiedProperties()->create([
                'income_from_house_property_id' => $income->id,
                'property_address' => $this->selfAddress ?? null,
                'ownership_percent' => $this->selfOwnershipPercent ?? null,
                'interest_certificate' => $this->selfInterestCertificate
                    ? $this->selfInterestCertificate->store('uploads/property/self_interest', 'public')
                    : null,
            ]);
        }

        session()->flash('message', 'House property income saved!');
    }

    public function render()
    {
        return view('livewire.income-from-house-property-form');
    }
}

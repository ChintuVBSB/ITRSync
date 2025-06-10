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

    public array $rentedProperties = [];
    public $selfAddress;
    public $selfOwnershipPercent;
    public $selfInterestCertificate;
    protected $listeners = ['switch-tab' => 'save'];

    public function mount(Submission $submission)
    {
        $this->submission = $submission;

        // preload existing data if needed
        $income = $this->submission->incomeFromHouseProperty()->firstOrCreate([]);
        
        if ($income) {
            $this->rentedProperties = $income->rentedProperties->map(fn ($r) => [
                'tenant_name' => $r->tenant_name,
                'property_address' => $r->property_address,
                'rental_income' => $r->rental_income,
                'ownership_percent' => $r->ownership_percent,
                'months_occupied' => $r->months_occupied,
                'house_tax_receipt' => null,
                'interest_certificate' => null,
            ])->toArray();

            $self = $income->selfOccupiedProperties->first();
            if ($self) {
                $this->selfAddress = $self->property_address;
                $this->selfOwnershipPercent = $self->ownership_percent;
            }
        }
    }

    public function addRentedProperty()
    {
        $this->rentedProperties[] = [
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
        unset($this->rentedProperties[$index]);
        $this->rentedProperties = array_values($this->rentedProperties);
    }

    public function save()
    {
        $income = $this->submission->incomeFromHouseProperties()->firstOrCreate([]);

        // Clean old data
        $income->rentedProperties()->delete();
        $income->selfOccupiedProperties()->delete();

        // Save rented
        foreach ($this->rentedProperties as $property) {
            $houseTax = $property['house_tax_receipt']?->store('uploads/property/house_tax', 'public');
            $interestCert = $property['interest_certificate']?->store('uploads/property/interest', 'public');

            $income->rentedProperties()->create([
                'tenant_name' => $property['tenant_name'],
                'property_address' => $property['property_address'],
                'rental_income' => $property['rental_income'],
                'ownership_percent' => $property['ownership_percent'],
                'months_occupied' => $property['months_occupied'],
                'house_tax_receipt' => $houseTax,
                'interest_certificate' => $interestCert,
            ]);
        }

        // Save self-occupied
        $selfInterest = $this->selfInterestCertificate?->store('uploads/property/self_interest', 'public');

        $income->selfOccupiedProperties()->create([
            'property_address' => $this->selfAddress,
            'ownership_percent' => $this->selfOwnershipPercent,
            'interest_certificate' => $selfInterest,
        ]);

        session()->flash('message', 'House property income saved!');
    }

    public function render()
    {
        return view('livewire.income-from-house-property-form');
    }
}

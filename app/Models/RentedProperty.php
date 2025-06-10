<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentedProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_from_house_property_id',
        'tenant_name',
        'property_address',
        'rental_income',
        'house_tax_receipt',
        'interest_certificate',
        'ownership_percent',
        'months_occupied',
    ];

    public function incomeFromHouseProperty()
    {
        return $this->belongsTo(IncomeFromHouseProperty::class);
    }
}

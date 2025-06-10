<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SelfOccupiedProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_from_house_property_id',
        'property_address',
        'interest_certificate',
        'ownership_percent',
    ];

    public function incomeFromHouseProperty()
    {
        return $this->belongsTo(IncomeFromHouseProperty::class);
    }
}

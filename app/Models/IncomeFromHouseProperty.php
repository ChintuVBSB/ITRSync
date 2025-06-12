<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeFromHouseProperty extends Model
{
    use HasFactory;
    public array $rentedProperties = [];
    
    protected $fillable = [
        'submission_id',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function rentedProperties()
    {
        return $this->hasMany(RentedProperty::class);
    }

    public function selfOccupiedProperties()
    {
        return $this->hasMany(SelfOccupiedProperty::class);
    }
}

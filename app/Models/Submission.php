<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\User;

class Submission extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'submission_id',
        'user_id',
        'person_id',
        'year',
        'status',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incomeTypes()
    {
        return $this->belongsToMany(IncomeType::class, 'income_type_submission');
    }

    public function deductionTypes()
    {
        return $this->belongsToMany(DeductionType::class, 'deduction_type_submission');
    }

    public function incomeFromHouseProperty()
    {
        return $this->hasMany(IncomeFromHouseProperty::class);
    }

    public function incomeFromSalary()
    {
        return $this->hasOne(IncomeFromSalary::class);
    }

    public function incomeFromBusiness()
    {
        return $this->hasOne(IncomeFromBusiness::class);
    }

    public function incomeFromCapitalGains()
    {
        return $this->hasOne(IncomeFromCapitalGain::class);
    }

    public function incomeFromOtherSources()
    {
        return $this->hasOne(IncomeFromOtherSource::class);
    }

    public function deduction80C()
    {
        return $this->hasOne(Deduction80C::class);
    }

    public function deduction80D()
    {
        return $this->hasOne(Deduction80D::class);
    }

    public function deduction80E()
    {
        return $this->hasOne(Deduction80E::class);
    }

    public function deduction80G()
    {
        return $this->hasOne(DeductionDonation::class);
    }

    public function deductionOther()
    {
        return $this->hasOne(DeductionOtherDocument::class);
    }
}

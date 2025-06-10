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
        return $this->hasOne(\App\Models\IncomeFromHouseProperty::class);
    }
    public function incomeFromSalaries()
    {
        return $this->hasOne(\App\Models\IncomeFromSalary::class);
    }

    public function incomeFromBusiness()
    {
        return $this->hasOne(\App\Models\IncomeFromBusiness::class);
    }

    public function incomeFromOtherSources()
    {
        return $this->hasOne(\App\Models\IncomeFromOtherSource::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\User;
class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'user_id',
        'person_id',
        'year',
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
}

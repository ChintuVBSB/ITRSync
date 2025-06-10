<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeFromBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function presumptiveBusinesses()
    {
        return $this->hasMany(PresumptiveBusiness::class);
    }

    public function normalBusinesses()
    {
        return $this->hasMany(NormalBusiness::class);
    }

    public function firmIncomes()
    {
        return $this->hasMany(FirmIncome::class);
    }
}

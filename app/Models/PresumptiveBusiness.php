<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PresumptiveBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_from_business_id',
        'name',
        'bank_sales',
        'cash_sales',
    ];

    public function incomeFromBusiness()
    {
        return $this->belongsTo(IncomeFromBusiness::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeductionDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'donation_receipts',
    ];

    protected $casts = [
        'donation_receipts' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deduction80D extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'mediclaim_receipts',
    ];

    protected $casts = [
        'mediclaim_receipts' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    //
    protected $fillable = [
        'person_id',
        'bank_name',
        'account_number',
        'ifsc_code',
    ];
    public function person(){
        return $this->belongsTo(Person::class);
    }
}

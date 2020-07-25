<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = ['bankName', 'bankCountry', 'accountName', 'accountNumber'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

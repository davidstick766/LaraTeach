<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['type', 'amount'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function publisher(){
        return $this->belongsTo('App\Publisher');
    }
}

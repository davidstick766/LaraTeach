<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //
    protected $table = 'publishers';
    protected $fillable = ['user_id', 'account_type', 'followers_amount', 'niche', 'is_blocked'];

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    //
    protected $fillable = ['user_id', 'type', 'company_name', 'company_address', 'company_email', 'company_phone', 'company_state', 'company_country', 'company_size', 'company_position', 'account_type'] ;

    protected $guarded = ['blocked'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function campaign()
    {
       return $this->hasMany('App\Campaign');
    }
}

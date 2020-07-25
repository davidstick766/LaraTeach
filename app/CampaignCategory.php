<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignCategory extends Model
{
    protected $table = 'campaign_categories';

    public function campaign(){
        return $this->hasMany('App\Campaign');
    }
}

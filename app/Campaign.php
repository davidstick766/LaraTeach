<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //

    protected $table = 'campaigns';

    //protected $fillable = ['user_id','advertiser_id','campaign_about','category_id','is_approved'];
    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function advertiser(){
        return $this->belongsTo('App\Advertiser');
    }

    public function campaignCategory(){
        return $this->belongsTo('App\CampaignCategory');
    }
}

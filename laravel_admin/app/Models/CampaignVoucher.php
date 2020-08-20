<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignVoucher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id','voucher_code','redeem_status','redeem_date','redeem_IP','redeem_email_id','redeem_project_id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function campaign() {
        return $this->belongsTo('App\Models\Campaign');
    }

    public function email() {
        return $this->belongsTo('App\Models\EmailListValue');
    }

    public function project() {
        return $this->belongsTo('App\Models\Project');
    }
}

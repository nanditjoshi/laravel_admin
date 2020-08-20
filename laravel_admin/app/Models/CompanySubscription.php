<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySubscription extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','subscription_id'
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

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function subscription() {
        return $this->belongsTo('App\Models\Subscription');
    }

    public function transaction() {
        return $this->hasOne('App\Models\SubscriptionTransaction');
    }
}

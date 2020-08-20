<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','title','start_date','end_date','total_vouchers','delivery_method','hash_code','voucher_value_id'
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templates() {
        return $this->hasOne('App\Models\CampaignTemplate');
    }

    /*
     * one to many relation with users table
     */
    public function emails() {
        return $this->hasOne('App\Models\EmailList');
    }
    ////////////////////////////////////////////////////////////////


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project');
    }

    ////////////////////////////////////////////////////////////////

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouchers() {
        return $this->hasMany('App\Models\CampaignVoucher');
    }


    /**
     * Get a validator for company name.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:campaigns' . ($id != '' ? ',title,'.$id : '')
        ]);
    }
}

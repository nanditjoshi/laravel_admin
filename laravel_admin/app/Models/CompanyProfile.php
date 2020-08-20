<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'address1', 'address2', 'logo', 'description', 'phone', 'website','region_id'
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

    public function region() {
        return $this->belongsTo('App\Models\Region');
    }

    /**
     * Get a validator for company profile.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'logo' => 'required|max:255' ,
            'description' => 'required|max:255',
            'phone' => 'required|max:255',
            'website' => 'required|max:255',
            'region_id' => 'required'
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Company extends Model
{
    use SoftDeletes;

   const COMPANY_ORGANIZATION = 1;
   const COMPANY_CHARITY = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','name'
    ];

    protected $dates = [
        'deleted_at',
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


    /*
     * one to many relation with users table
     */
    public function users() {
        return $this->hasMany('App\Models\User');
    }

    /*
     * one to one relation with company profile
     */
    public function profile()
    {
        return $this->hasOne('App\Models\CompanyProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * one to one relation with company configuration
     */
    public function configuration()
    {
        return $this->hasOne('App\Models\CompanyConfiguration');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * one to one relation with company subscriptions
     */
    public function subscriptions() {
        return $this->hasMany('App\Models\CompanySubscription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects() {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * Get a validator for company name.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = 0) {
        return Validator::make($data, [
            'name' => [
                'required',
                'max:255',
                Rule::unique('companies')->ignore($id),
            ],
            'type' => 'required|in:' . implode(',', array(Company::COMPANY_ORGANIZATION,Company::COMPANY_CHARITY)),
            'email' => 'required|email|max:255|unique:users' . ($id != '' ? ',email,'.$id : '')
        ]);

    }

}

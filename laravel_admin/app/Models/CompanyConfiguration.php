<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'stmp_out', 'stmp_in', 'domain', 'port', 'username', 'password'
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

    /**
     * Get a validator for company profile.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'stmp_out' => 'required',
            'stmp_in' => 'required',
            'domain' => 'required' ,
            'port' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
    }
}

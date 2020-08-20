<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_name','cost_year','limit_value'
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
     * Get a validator for company name.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'plan_name' => 'required|max:255|unique:voucher_values' . ($id != '' ? ',plan_name,'.$id : ''),
            'cost_year' => 'required',
            'limit_value' => 'required'
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects() {
        return $this->hasMany('App\Models\Project');
    }
}

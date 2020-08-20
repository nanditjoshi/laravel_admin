<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailListValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_list_id', 'email', 'opt-out status'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_date_time' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Get a validator for user.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:email_list_values' . ($id != '' ? ',email,'.$id : '')
        ]);
    }

    public function list() {
        return $this->belongsTo('App\Models\EmailList');
    }

}

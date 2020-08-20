<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const SUPER_ADMIN = 1;
    const COMPANY_ADMIN = 2;
    const COMPANY_USER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'role_id', 'phone', 'birth_date', 'avatar','company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
        return trim($this->attributes['first_name'] . " " .$this->attributes['last_name']);
    }

    /**
     * Get a validator for user.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        $messages = array(
            'required_if' => 'Please select company.'
        );
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users' . ($id != '' ? ',email,'.$id : ''),
            'password' => ($id == '' ? 'required|confirmed|min:6' : ''),
            'role_id' => 'required',
            'company_id' =>  'required_if:role_id,2|required_if:role_id,3'
        ],$messages );
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

    public function getRoleName(){
        return $this->role->name;
    }

    public function can($permission, $arguments = []) {
        return ($this->role->permissions->where('name', $permission)->count() > 0);
    }

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function getCompanyName(){
        return $this->company->name;
    }

    public static function generatePassword(){
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@!#$%&*') , 0 , 10 );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name'
    ];

    public function permissions() {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function users() {
        return $this->hasMany('App\Models\User');
    }

    /**
     * Get a validator for role.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:roles' . ($id != '' ? ',name,'.$id : '')
        ]);
    }

    public static function defaultRole(){
        $defaultRoleName = config('avdevs.default_role', 'Guest');
        $role = Role::firstOrNew([
            'name' => $defaultRoleName
        ]);
        return $role->id;
    }

    public static function getCompanyAdminId(){
        $role = Role::where('name', 'Company Admin')->first();
        if($role instanceof Role) {
            return $role->id;
        } else {
            return 0;
        }
    }

}

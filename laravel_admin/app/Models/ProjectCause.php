<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCause extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status'
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
    public function projects() {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * Get a validator for company name.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $id = '') {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:regions' . ($id != '' ? ',title,'.$id : '')
        ]);
    }
}

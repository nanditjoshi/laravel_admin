<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id', 'is_deleted'
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

    public function campaign() {
        return $this->belongsTo('App\Models\Campaign');
    }

    /*
     * one to many relation with users table
     */
    public function emails() {
        return $this->hasMany('App\Models\EmailListValue');
    }

}

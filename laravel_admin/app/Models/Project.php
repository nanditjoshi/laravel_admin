<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','title','description','website','voucher_value_id','status','end_date','start_date',
        'thumbnail_image','tagline','project_cause_id'
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

    public function vouchers() {
        return $this->belongsTo('App\Models\VoucherValue');
    }

    public function causes() {
        return $this->belongsTo('App\Models\ProjectCause');
    }

    // Many to many relation
    public function campaigns() {
        return $this->belongsToMany('App\Models\Campaign');
    }

}

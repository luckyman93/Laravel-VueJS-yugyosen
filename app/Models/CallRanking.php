<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallRanking extends BaseModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'boat_id',
        'call_count',
    ];

    // public function prefecture()
    // {
    //     return $this->belongsTo(Prefecture::class);
    // }

    // public function ports()
    // {
    //     return $this->hasMany(Port::class);
    // }
}
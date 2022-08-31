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

    public function Boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id', 'id');
    }

    // public function lender()
    // {
    //     return $this->belongsTo(Lender::class, 'boat.lender_id', 'id');
    // }
}
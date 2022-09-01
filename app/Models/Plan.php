<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends BaseModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'lender_id',
        'plan_name',
        'plan_description',
        'delay',
        'price_includes',
        'to_prepare',
        'collection',
        'return',
        'reservation',
        'other',
    ];
}
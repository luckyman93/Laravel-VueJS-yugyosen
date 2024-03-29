<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends BaseModel
{
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'news_title',
        'news_content',
        'created_user_id',
        'updated_user_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    protected $fillable = [
        'postable_id',
        'image',
        'title',
        'description',
        'content',
        'is_recommend',
        'is_pin',
    ];
}

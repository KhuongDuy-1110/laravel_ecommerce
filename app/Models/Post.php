<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

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

    public function user()
    {
        return $this->hasOne(Admin::class, 'id', 'postable_id');
    }
}

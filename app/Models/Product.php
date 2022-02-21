<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name', 'title', 'description', 'photo', 'category_id', 'price', 'hot',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

}

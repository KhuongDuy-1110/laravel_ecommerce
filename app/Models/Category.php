<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'parent_id', 'name'
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($category) {
            $category->product()->delete();
        });
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}

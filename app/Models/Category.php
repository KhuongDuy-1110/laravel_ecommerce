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

    public function product(){
        return $this->hasMany(Product::class);
    }
}

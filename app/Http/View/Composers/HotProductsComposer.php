<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Product;

class HotProductsComposer
{
    public function compose (View $view)
    {
        $view->with('HotProducts',Product::where('hot',1)->orderBy('id','desc')->get());
    }
}
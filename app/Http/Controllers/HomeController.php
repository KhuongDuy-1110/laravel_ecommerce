<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('frontend/Home',['title'=>'Home']);
    }
}

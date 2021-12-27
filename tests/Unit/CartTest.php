<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Mockery;
// use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;

class CartTest extends TestCase
{
    public function testUpdateCart()
    {
        
        $cartController = Mockery::mock(CartController::class)->makePartial();
        $cartController->shouldReceive('updateCart')
                        ->with(5)
                        ->andReturn(6);
        $result = $cartController->updateCart(5);
        $this->assertEquals(6,$result);
                        
    }

    public function testAddCart()
    {
        $input = [
            "id" => 1,
            "name" => "Pro 1",
            "title" => "Lorem ispum",
            "hot" => 1,
            "description" => "Lorem ispum Lorem ispum Lorem ispum",
            "photo" => "sara-cervera-RXFo8ipUZfg-unsplash_1638860665.jpg",
            "price" => 12000,
            "category_id" => 1,
            "created_at" => "2021-12-07 06:37:08",
            "updated_at" => "2021-12-07 07:04:25", 
        ];
        
        $cartController = Mockery::mock(CartController::class)->makePartial();
        $cartController->shouldReceive('AddCart')
                        ->with($input['id'])
                        ->andReturn(withSession('cart'));


    }

}

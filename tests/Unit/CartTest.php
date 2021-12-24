<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
// use Tests\TestCase;
use App\Http\Controllers\CartController;

class CartTest extends TestCase
{
    public function testAddCart()
    {
        
        $cartController = Mockery::mock(CartController::class)->makePartial();
        $cartController->shouldReceive('AddCart')
                        ->with()
                        ->andReturn();

                        
    }
}

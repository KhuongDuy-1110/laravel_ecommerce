<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Http\Controllers\CartController;

class CartTest extends TestCase
{
    public function testUpdateCart()
    {
        
        $cartController = Mockery::mock(CartController::class)->makePartial();
        $cartController->shouldReceive('AddCart')
                        ->with(5)
                        ->andReturn(6);
        $result = $cartController->updateCart(5);
        $this->assertEquals(6,$result);
                        
    }
}

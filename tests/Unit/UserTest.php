<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// use Illuminate\Support\Facades\Bus;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use App\Jobs\SendOrderMail;

// use App\ClassToMock;
use App\Http\Controllers\Admin\UserController;
use App\Repository\UserRepositoryInterface;
use Tests\TestCase;
use Mockery;

class UserTest extends TestCase
{

    protected $controller, $mockObject;
    
    // public function setUp() : void
    // {
    //     parent::setUp();
    //     $this->mockObject = Mockery::mock(UserController::class);
    //     $this->controller = new UserController($this->mockObject);
    // }
    
    // public function tearDown() : void
    // {
        
    //     Mockery::close();
    //     unset($this->controller);
    //     parent::tearDown();

    // }


    public function test()
    {

        // $userController = Mockery::mock(UserController::class)->makePartial();
        // $userController->shouldReceive('index')
        //                 ->withNoAgrs()
        //                 ->andReturn(3);
        


        // $this->mockObject->shouldReceive('index');

    }

}

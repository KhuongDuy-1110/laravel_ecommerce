<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;
use App\Services\UserService;
use App\Services\ImageService;
use App\Services\PostService;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Product;

class HomeController extends Controller
{
    private $orderService;
    private $userService;
    private $imageService;
    private $postService;

    public function __construct(OrderService $orderService, UserService $userService, ImageService $imageService, PostService $postService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->imageService = $imageService;
        $this->postService = $postService;
    }

    public function index()
    {
        $slides = $this->imageService->getImageByType(1, 1);
        $newestPost = $this->postService->getLastestPost();
        $posts = $this->postService->getAllPosts(2);
        return view('frontend/Home',[
            'title'=>'Bao Phat Smart Devices',
            'slides' => $slides,
            'newestPost' => $newestPost,
            'posts' => $posts
        ]);
    }

    public function profile()
    {
        $user = $this->userService->getUsers(Auth::id());
        return view('frontend.UserProfile',['user'=>$user]);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $this->userService->update($request, Auth::id());
        return redirect()->back()->with('success','Update profile successfully');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $data['id'] = Auth::id();
        $result = $this->userService->changePassword($data);
        if($result) {
            return redirect()->route('profile')->with('success','Your password has been updated !');
        }
        return redirect()->route('profile')->with('warning','Something went wrong, please check it later !');
    }

    public function order()
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        return view('frontend.UserOrders',['orders'=>$orders]);
    }

    public function showPostDetail($id)
    {
        $post = $this->postService->find($id);
        return view('frontend.PostDetail', ['post'=>$post]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= 
                    '<tr>
                        <td style="padding:10px 50px 10px 10px">'. '<img src="' . 'images/'.$product->photo.'">'. '</td>
                        <td style="padding-right:50px"><a href="products/detail/'.$product->id.'" class="alert-link" style="color: black;">' . stringLimitedHelper($product->name, 10) . '</a></td>
                        <td style="padding-right:50px">' .'('. stringLimitedHelper($product->title, 12) .')'. '</td>
                        <td style="padding-right:25px">' .'$'. $product->price . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}

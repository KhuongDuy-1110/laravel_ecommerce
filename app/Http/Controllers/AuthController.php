<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Jobs\SendRegisterMail;
use Carbon\Carbon;
use App\Models\Category;
use App\Repository\UserRepositoryInterface;
use App\Services\UserService;
use App\Http\Requests\ForgotPassRequest;

class AuthController extends Controller
{

    private $userRepository;
    private $userService;

    public function __construct(UserService $userService, UserRepositoryInterface $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

    }

    public function register(AuthRequest $request)
    {
        $result = $this->userService->register($request);
        if($result) {
            return redirect(url('/login'))->with('success', 'Thank you for register - Please check your mail to verify !');
        } else {
            return redirect(url('/login'))->with('warning', 'Something went wrong - Please try again !');
        }
    }

    public function authenticate(Request $request)
    {   

        $remember_me = $request->has('remember') ? true : false;  
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember_me)) {

            if (Auth::User()->email_verified_at == null) {
                Auth::logout();
                return redirect()->back()->with('warning', 'Your mail was unverified');
            }
            return redirect(url('/'));

        }
        return redirect()->back()->with('warning', 'Your password or email is wrong');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }

    public function verified(Request $request)
    {
        $find = $this->userRepository->getDataFiltered('verification_code', $request->code);

        if ($find != null && $find->email_verified_at == null) {
            if (Carbon::now('Asia/Ho_Chi_Minh') < $find->expired_at) {
                $this->userRepository->update($find->id, ["email_verified_at" => Carbon::now('Asia/Ho_Chi_Minh')]);
                return redirect(url('/login'))->with('success', 'Your mail was verified, log in now !');
            }
            return redirect(url('/login'))->with('warning', 'Time expired');
        }
        return redirect(url('/login'))->with('warning', 'Something went wrong !');
    }

    public function forgotPassword()
    {
        return view('frontend.ForgotPassword', ['title' => 'Forgot password']);
    }

    public function sendLink(ForgotPassRequest $request)
    {
        $data = $request->validated();
        $result = $this->userService->sendLinkForgotPassword($data);
        if($result) {
            return redirect()->route('user.login')->with('success', 'Check your mail to get link !');
        }
        return redirect()->route('user.login')->with('warining', 'Your email or password was not true !');
    }

    public function setDefaultPassword(Request $request)
    {
        $result = $this->userService->setPasswordToDefault($request->code);
        if($result) {
            return redirect()->route('user.login')->with('success', 'Your password was reseted successfully !');
        }
        return redirect()->route('user.login')->with('warning', 'Something went wrong, check it later !');
    }
}
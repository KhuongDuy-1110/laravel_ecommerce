<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Jobs\SendRegisterMail;
use Carbon\Carbon;
use App\Category;
use App\Repository\UserRepositoryInterface;

class AuthController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        
    }
    public function register(AuthRequest $request)
    {

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "verification_code" => sha1(time()),
            "expired_at" => Carbon::now('Asia/Ho_Chi_Minh')->addSecond(300),
        ];

        $user = $this->userRepository->create($data);

        if($user == true)
        {
            $find = DB::table("users")->where("email","=",$request->email)->first();

            // send verrification mail

            MailController::verificationMail($find->email,$find->verification_code);

            return redirect(url('/login'))->with('flash_success', 'Check your mail to verify');
        }

        return redirect()->back();
    }

    public function authenticate(Request $request)
    {
         if(Auth::attempt([
             'email' => $request->input('email'),
             'password' => $request->input('password'),
         ], ))
         {
             if(Auth::User()->role == 0)
             {

                if(Auth::User()->email_verified_at == null)

                    return redirect()->back()->with('flash_warning', 'Your mail was unverified');

                return redirect(url('/'));

             }
             else if(Auth::User()->role == 1) {

                 return redirect(url('/admin'));

             }

             return redirect()->back();
             
         }
         return redirect()->back()->with('flash_warning', 'Your password or email is wrong');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }

    public function verified(Request $request)
    {
        // $find = DB::table("users")->where("verification_code","=",$request->code)->first();

        $find = $this->userRepository->getDataFiltered('verification_code',$request->code);

        if($find != null && $find->email_verified_at == null )
        {
            if(Carbon::now('Asia/Ho_Chi_Minh') < $find->expired_at )
            {
                // DB::table("users")->where("verification_code","=",$request->code)->update(["email_verified_at" => Carbon::now('Asia/Ho_Chi_Minh')]);

                $this->userRepository->update($find->id, ["email_verified_at" => Carbon::now('Asia/Ho_Chi_Minh')] );

                return redirect(url('/login'))->with('flash_success', 'Your mail was verified, log in now !');
            }
            return redirect(url('/login'))->with('flash_warning', 'Time expired');
        }
        return redirect(url('/login'))->with('flash_warning', 'Something went wrong !');


    }
  
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Services\VerificationServices;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\VerificationRequest;
class VerificationCodeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */



    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
   # protected $redirectTo = RouteServiceProvider::HOME;

   protected function redirectTo()
   {
       return route('home'); // Redirects to the named route 'home'
   }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public $verificationService;
     public function __construct(VerificationServices $verificationService)
     {
         $this  -> verificationService = $verificationService;
     }

    public function verify(VerificationRequest $request)
    {
        $check = $this ->  verificationService -> checkOTPCode($request -> code);
        if(!$check){  // code not correct
          //  return 'you enter wrong code ';
            return redirect() -> route('get.verification.form')-> withErrors(['code' => 'ألكود الذي ادخلته غير صحيح ']);
        }else {  // verifiction code correct
            $this ->  verificationService -> removeOTPCode($request -> code);
            return redirect()->route('home');
        }
    }

    public function getVerifyPage()
    {
        return view('auth.verifyCode') ;
    }
}

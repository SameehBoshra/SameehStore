<?php
namespace App\Http\Services;

use App\Models\UsersVerficationCodes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationServices{

    public function setVerificationCode($data)
    {
        $code=mt_rand(1000000 , 9999999);
        $data['code']=$code;

        UsersVerficationCodes::whereNotNull('user_id')->where(['user_id'=>$data['user_id']])->delete();
        return UsersVerficationCodes::create($data);
    }

    //function return message and the code for mobile user

    public function getSmsVerfiyMessageAppName($code)
    {
        $message="Is your verfication code for your account";

        return $code.$message;
    }

    public function checkOTPCode ($code){

        if (Auth::guard()->check()) {
            $verificationData = UsersVerficationCodes::where('user_id',Auth::id()) -> first();

            if($verificationData -> code == $code){
                User::whereId(Auth::id()) -> update(['email_verified_at' => now()]);

       return true;
            }else{
                return false;
            }
        }
        return false ;
    }


    public function removeOTPCode($code)
    {
        UsersVerficationCodes::where('code',$code) -> delete();
    }





}

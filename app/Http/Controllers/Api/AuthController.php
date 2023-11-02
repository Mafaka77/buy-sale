<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
//        info($request->mobile);
//        $mobile=$this->validate($request,[
//            'mobile'=>'required'
//        ]);
        $otp='1234';
        $user=User::query()->where('mobile',$request->mobile)->first();
        if($user == null) {
            $user = new User();
            $user->mobile = $request->mobile;
        }
        $user->otp=$otp;
        $user->save();
        return response()->json(['otp'=>'OTP sent to your mobile number','user_id'=>$user->id]);
    }

    public function verifyOtp(Request $request,int $id)
    {
        $otp=$request->otp;
        $user=User::query()->where('id',$id)->first();
        if($user->otp==$otp){
            Auth::login($user);
            $user->otp='';
            $user->save();
            $data=Auth::user();
            $token=$data->createToken('sale_token');
            return response()->json(['user_id'=>$data->id,'token'=>$token->plainTextToken,'mobile'=>$data->mobile,'is_profile_completed'=>$data->is_profile_completed],200);

        }else{
            return response()->json(['error' => 'The provided OTP does not match!'], 401);
        }

    }

    public function userDetails(Request $request)
    {
        $id=$request->id;
        $name=$request->name;
        $email=$request->email;
        $user=User::query()->where('id',$id)->first();
        $user->is_profile_completed=1;
        $user->update(['name'=>$name,'email'=>$email]);
        return response()->json(['data'=>'Profile saved'],200);
    }

    public function getUserData(Request $request,int $id)
    {
        $data=User::query()
            ->where('id',$id)
            ->first();
        return response()->json(['data'=>$data],200);
    }
}

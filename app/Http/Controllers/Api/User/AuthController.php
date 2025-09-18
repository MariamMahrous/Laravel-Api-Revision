<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    use GeneralTrait;
    public function userLogin(Request $request){
        //Validation
         $rules=[
    'email'=> 'required|email',
    'password'=>'required'
   ];
   
        $validatior=Validator::make($request->all(),$rules);

        if($validatior->fails())
            return response()->json($validatior->errors());

        $cerdintials=$request->only(['email','password']);
       $token= Auth::guard('user_api')->attempt($cerdintials);
    
       if(!$token)
        return $this->returnError("202","  الايميل او الرقم السرى غير صحيح  ");
       
          $user=Auth::guard('user_api')->user();
          $user->api_token=$token;
      return $this->returnData(true,'user',$user);




    }


    public function logout(Request $request){
        $token=$request->header('auth_token');

        if($token){
            try{
 JWTAuth::setToken($token)->invalidate();
       return $this->returnSuccess("200","Logout Success");
            }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                 return $this->returnError("202","SomeThing Wrong ");
            }
      
        }else{
            return $this->returnError("202","SomeThing Wrong ");
        }

    }
}

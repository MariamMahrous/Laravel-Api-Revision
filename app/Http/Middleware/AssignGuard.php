<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssignGuard extends BaseMiddleware
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard =null)
    {
        if($guard !=null)
            auth()->shouldUse($guard);

        $token = $request->header('auth_token');    
        $request->headers->set('auth_token',$token,true);
        $request->headers->set('Authorization', 'Bearer ' . $token, true);
          

      try{
           
           
  $user = JWTAuth::parseToken()->authenticate();

        }catch(TokenExpiredException $e){
 return $this->returnError("401","Unauthunticated User");

        }catch(JWTException $e){
 return $this->returnError("401","Token Invalid",$e->getMessage());

        }

        return $next($request);
    }
}

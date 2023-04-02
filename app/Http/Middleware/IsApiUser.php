<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsApiUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has('access_token')){
            if($request->access_token !== null){
                $user = User::where('access_token', $request->access_token)->first();
                if($user !== null){
                    return $next($request);
                }else{
                    return response()->json("access token is not correct");
                }
            }else{
                return response()->json("access token is empty");
            }
        }else{
            return response()->json("There is no access token");
        }
    }
}

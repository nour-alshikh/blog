<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function handleLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|string|max:50|min:4',
        ]);

        if($validator->fails()){
            $err = $validator->errors();
            return response()->json($err);
        }

        $is_login = Auth::attempt(['email' =>$request->email, 'password' =>$request->password]);

        if(!$is_login){
            $err = "Credintials are not correct";
            return response()->json($err);
        }else{
            $user = User::where('email' , '=' , $request->email)->first();
            $new_access_token = Str::random(64);
            $user->update([
                'access_token' => $new_access_token
            ]);
            return response()->json($new_access_token);

        return response()->json($user->access_token);
    }
}

    public function handleRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|string|max:50|min:4',
        ]);

        if($validator->fails()){
            $err = $validator->errors();
            return response()->json($err);
        }

        $user  = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'access_token' =>Str::random(64)
        ]);

        return response()->json($user->access_token);
    }

    public function logout(Request $request){
        $user = User::where('access_token' , '=' ,$request->access_token);

        $user->update([
            'access_token' => Null
        ]);
        $success = "Logged out successfully";
        return response()->json($success);
    }
}

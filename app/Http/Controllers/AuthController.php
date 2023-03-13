<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function handleRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|string|max:50|min:4',
        ]);

        $user  = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect(route('books'));
    }

    public function login(){
        return view('auth.login');
    }

    public function handleLogin(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|max:50|min:4',
        ]);

        $is_login = Auth::attempt(['email' =>$request->email, 'password' =>$request->password]);
        if(!$is_login){
            return back();
        }else{
            return redirect(route('books'));
        }
    }

    public function logout(){
        Auth::logout();
        return back();
    }
}
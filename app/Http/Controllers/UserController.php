<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|unique:users|email',
            'password'  => 'required|min:6',
        ]);

        $email      = $request->input('email');
        $password   = Hash::make($request->input('password'));
        
        $user = User::create([
           'email'      => $email,
           'password'   => $password, 
        ]);

        return response()->json('Data added successfully', 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ]);

        $email      = $request->input('email');
        $password   = $request->input('password');
        
        $user   = User::where('email', $email)->first();
        if (!$email){
            return response()->json('Login failed', 401);
        }

        $isValidPassword = Hash::check($password, $user->password);
        if (!$password)
        {
            return response()->json('Login failed', 401);
        }

        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $generateToken,
        ]);

        return response()->json($user);
    }

    public function logout(Request $request)
    { 
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }

        return response()->json('Logout success');
    }
}
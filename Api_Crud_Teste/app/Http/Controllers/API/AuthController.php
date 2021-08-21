<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $validate['password'] = Hash::make($request->password);

        $user = User::create($validate);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'acess_token' => $accessToken
        ]);

    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => ['email', 'required'],
            'password' => 'required'
        ]);

            if(!auth()->attempt($login)):
                return response(['erroLogin'=> 'Email Ou Senha Invalidos!']);
            endif;

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['user'=> auth()->user(), 'accessToken'=> $accessToken]);
    }
}

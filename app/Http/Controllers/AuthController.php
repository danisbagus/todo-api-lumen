<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        if($register) {
            return response()->json([
                'success' => true,
                'message' => 'Register success',
                'data' => $register,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register failed',
                'data' => '',
            ], 400);
        }

    }

    public function login(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if(Hash::check($password, $user->password)) {
            $apiToken = base64_encode(Str::random(32));

            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login success',
                'data' => [
                    'user' => $user,
                    'api_token' => $apiToken
                ],
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'data' => '',
            ], 400);
        }
    }
}

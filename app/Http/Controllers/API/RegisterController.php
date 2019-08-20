<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = \Validator::make($request->json()->all(),
            [
                "name" => "required",
                "email" => "required|email",
                "password" => "required",
                "same_password" => "required|same:password"
            ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    "success" => false,
                    "error" => "Validation Error " . $validator->errors()
                ]
            );
        }


        $data = $request->json()->all();
        $data["password"] = \Hash::make($data["password"]);
        $user = User::create($data);
        $user->assignRole("user");
        $token = $user->createToken("My token");
        $accessToken = $token->accessToken;

        return response()->json(
            [
                "success" => true,
                "token" => $accessToken
            ]
        );
    }

    public function login(Request $request)
    {
        $data = $request->json()->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(["message" => "You logged out"], 200);
    }
}

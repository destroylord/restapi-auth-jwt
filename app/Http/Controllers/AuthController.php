<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return response()
                    ->json($validator->errors()
                    ->toJson(), 400);
        }

        $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User success registered',
            'user' => $user
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserResquest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Add user
    public function register(CreateUserResquest $request)
    {

        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return [
                "status" => 200,
                "message" => "user added successfully",
                "user" => $user

            ];
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LoginUserRequest $request)
    {
        if (auth()->attempt($request->only(['name', 'password']))) {
            $user = auth()->user();
            $UserToken = $user->createToken('simeon-tambu')->plainTextToken;
            return response()->json(
                [
                    'status_code' => 200,
                    'status_message' => 'User login',
                    'user' => $user,
                    'token' => $UserToken
                ]
            );
        } else {
            return response()->json(
                [
                    'status_code' => 403,
                    'status_message' => 'The information provided does not correspond to any user'
                ]
            );
        }
    }
}

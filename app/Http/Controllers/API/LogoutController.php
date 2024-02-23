<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        $user = User::where('token', $token)->firstOrFail();
        $user->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'Vous êtes déconnecté.'
        ]);
    }
}
